<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use Illuminate\Validation\Rule;
use App\Mail\ParticipantCreated;
use App\Models\EventParticipant;
use App\Models\UploadedDocument;
use App\Jobs\SendParticipantEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Observers\CooperativeObserver;
use Illuminate\Support\Facades\Storage;

class CooperativeController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $cooperative = $user->cooperative;

        // Ensure the user is part of a cooperative
        if (!$cooperative) {
            return redirect()->route('some.route')->with('error', 'No cooperative assigned to this user.');
        }

        $totalParticipants = Participant::where('coop_id', $cooperative->coop_id)->count();

        // Get the limit from the request, default to 5
        $perPage = $request->input('limit', 5);

        $participants = Participant::with(['registration', 'cooperative', 'user'])
            ->where('coop_id', $cooperative->coop_id)
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%')
                        ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                        ->orWhere('designation', 'like', '%' . $request->search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($request) {
                            $userQuery->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                            $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
                        });
                });
            })
            ->paginate($perPage)
            ->appends(['limit' => $perPage, 'search' => $request->search]); // Preserve query parameters

        return view('components.cooperative.manage_participant.participant', compact('participants', 'totalParticipants'));
    }




    public function coopparticipantadd()
    {
        $events = Event::all();
        $cooperatives = Cooperative::all();
        $users = User::whereDoesntHave('cooperative')
            ->where('role', 'cooperative')
            ->get();

        $user = Auth::user();
        $cooperative = Cooperative::find($user->coop_id);
        $shareCapital = $cooperative->share_capital_balance ?? 0;

        // Get participant count for Youth Congress (event_id = 15)
        // Define limits for specific events
        $eventLimits = [
            14 => 350,
            15 => 150,
            18 => 300,
            13 => 500,
        ];

        $eventStatus = [];

        foreach ($eventLimits as $eventId => $limit) {
            $count = EventParticipant::where('event_id', $eventId)->count();
            $eventStatus[$eventId] = [
                'full' => $count >= $limit,
                'remaining' => max(0, $limit - $count),
                'total' => $limit,
            ];
        }


        // Remove full events from the $events collection
        $events = $events->filter(function ($event) use ($eventStatus) {
            return !isset($eventStatus[$event->event_id]) || !$eventStatus[$event->event_id]['full'];
        });


        $votes = 0;
        $remaining = $shareCapital;

        if ($remaining >= 25000) {
            if ($remaining >= 100000) {
                $votes = floor($remaining / 100000);
                $remaining %= 100000;

                // Add 1 vote if remaining is at least ₱25,000
                if ($remaining >= 25000) {
                    $votes += 1;
                }
            } else {
                // Between ₱25,000 and ₱99,999 → 1 vote
                $votes = 1;
            }
        }

        // Cap the votes at 5
        $votes = min($votes, 5);

        $existingVotingParticipants = Participant::where('coop_id', $user->coop_id)
            ->where('delegate_type', 'Voting')
            ->count();
        $canAddVoting = $existingVotingParticipants < $votes;

        return view('components.cooperative.manage_participant.add', compact(
            'cooperatives',
            'users',
            'events',
            'shareCapital',
            'votes',
            'canAddVoting',
            'eventStatus'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:participants,email|unique:cooperatives,email',
            'last_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'reference_number' => 'unique:participants,reference_number',
            'gender' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'designation' => 'nullable|string|max:255',
            'congress_type' => 'nullable|string|max:255',
            'religious_affiliation' => 'nullable|string|max:255',
            'tshirt_size' => 'nullable|string|max:5',
            'is_msp_officer' => 'required|string|max:3',
            'msp_officer_position' => 'nullable|string|max:255',
            'delegate_type' => 'required|string|max:10',
            'event_ids' => 'nullable|array',
            'event_ids.*' => 'exists:events,event_id',
        ]);


        $validatedData['coop_id'] = Auth::user()->coop_id;

        do {
            $referenceNumber = Str::upper(Str::random(6));
        } while (Participant::where('reference_number', $referenceNumber)->exists());

        $validatedData['reference_number'] = $referenceNumber;

        try {
            DB::beginTransaction();

            $participant = Participant::create($validatedData);

            $generatedPassword = Str::random(6);

            $user = User::create([
                'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'coop_id' => $validatedData['coop_id'],
                'email' => $validatedData['email'],
                'password' => Hash::make($generatedPassword),
                'role' => 'participant',
            ]);

            $participant->user_id = $user->user_id;
            $participant->save();

            $qrData = route('adminDashboard', ['coop_id' => $participant->coop_id]);

            // Retry mechanism for QR code generation (max 3 attempts)
            $maxRetries = 3;
            $attempt = 0;
            do {
                try {
                    $response = Http::timeout(60)->get('https://api.qrserver.com/v1/create-qr-code/', [
                        'data' => $qrData,
                        'size' => '200x200'
                    ]);
                    if ($response->successful()) {
                        break;
                    }
                } catch (\Exception $e) {
                    Log::warning("QR Code API attempt {$attempt} failed: " . $e->getMessage());
                }
                $attempt++;
                sleep(2); // Wait before retrying
            } while ($attempt < $maxRetries);

            if (!$response->successful()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to generate QR code after multiple attempts.'
                ], 500);
            }

            $path = 'qrcodes/participant_' . $participant->coop_id . '.png';
            Storage::disk('public')->put($path, $response->body());

            $participant->qr_code = $path;
            $participant->save();

            if ($request->has('event_ids')) {
                $participant->events()->attach($request->input('event_ids'));
            }

            // Retry mechanism for sending email (max 3 attempts)
            $emailSent = false;
            $emailAttempts = 0;
            while (!$emailSent && $emailAttempts < $maxRetries) {
                try {
                    // Mail::to($user->email)->queue(new ParticipantCreated($user, $generatedPassword));
                    SendParticipantEmail::dispatch($user, $generatedPassword);
                    $emailSent = true;
                } catch (\Exception $e) {
                    Log::warning("Email sending attempt {$emailAttempts} failed: " . $e->getMessage());
                    $emailAttempts++;
                    sleep(2); // Wait before retrying
                }
            }

            if (!$emailSent) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email after multiple attempts. Please try again later.'
                ], 500);
            }

            DB::commit();

            $cooperative = Cooperative::where('coop_id', $validatedData['coop_id'])->first();

            if ($cooperative) {
                $registrationFee = 4500;
                $totalParticipants = Participant::where('coop_id', $cooperative->coop_id)->count();

                $freeAmount = 0;
                $cetfRemittance = $cooperative->cetf_remittance ?? 0;

                // MIGS check
                $migsCount = GARegistration::where('coop_id', $cooperative->coop_id)
                    ->where('membership_status', 'Migs')
                    ->count();

                if ($migsCount >= 1) {
                    $freeAmount += 9000;
                }

                // Free per 100k remittance
                $free100kCount = floor($cetfRemittance / 100000);
                $freeAmount += $free100kCount * 4500;

                // Half CETF logic
                if ($cooperative->half_based_cetf && $cetfRemittance >= 50000 && $cetfRemittance < 100000) {
                    $freeAmount += 2250;
                }

                $totalRegFee = $totalParticipants * $registrationFee;
                $netRequiredRegFee = $totalRegFee - $freeAmount;

                // 🆕 New reg_fee_payable calculation (after netRequiredRegFee)
                $regFeePayable = $netRequiredRegFee;
                $regFeePayable -= ($cooperative->less_prereg_payment ?? 0);
                $regFeePayable -= ($cooperative->less_cetf_balance ?? 0);

                // 📝 Save both
                $cooperative->total_reg_fee = $totalRegFee;
                $cooperative->net_required_reg_fee = $netRequiredRegFee;
                $cooperative->reg_fee_payable = $regFeePayable;
                $cooperative->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Participant registered successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during participant registration: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again.'
            ], 500);
        }
    }


    // Show a specific participant
    public function show($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('components.cooperative.manage_participant.view', compact('participant'));
    }

    public function edit($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        $cooperatives = Cooperative::all();
        $events = Event::all();

        // ✅ Event capacity limits
        $eventLimits = [
            14 => 350,
            15 => 150,
            18 => 300,
            13 => 500,
        ];

        $eventStatus = [];

        foreach ($eventLimits as $eventId => $limit) {
            $count = EventParticipant::where('event_id', $eventId)->count();
            $eventStatus[$eventId] = [
                'full' => $count >= $limit,
                'remaining' => max(0, $limit - $count),
                'total' => $limit,
            ];
        }

        // ✅ Remove full events from list (optional – skip if you want to show disabled checkboxes instead)
        $events = $events->filter(function ($event) use ($eventStatus) {
            return !isset($eventStatus[$event->event_id]) || !$eventStatus[$event->event_id]['full'];
        });

        // ✅ Voting logic
        $shareCapital = $participant->cooperative->share_capital_balance ?? 0;
        $votes = 0;

        if ($shareCapital >= 25000) {
            $votes = 1;
        }

        if ($shareCapital >= 100000) {
            $votes += floor(($shareCapital - 25000) / 100000);
        }

        $votes = min($votes, 5);

        $currentVotingCount = Participant::where('coop_id', $participant->coop_id)
            ->where('delegate_type', 'Voting')
            ->where('participant_id', '!=', $participant->participant_id)
            ->count();

        $canAddVoting = $currentVotingCount < $votes || $participant->delegate_type === 'Voting';

        return view('components.cooperative.manage_participant.edit', compact(
            'participant',
            'cooperatives',
            'votes',
            'canAddVoting',
            'shareCapital',
            'currentVotingCount',
            'events',
            'eventStatus'
        ));
    }



    public function update(Request $request, $participant_id)
    {
        // Find the participant
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();

        // Validate the form data
        $validatedData = $request->validate([
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email')->ignore($participant->participant_id, 'participant_id'),
                Rule::unique('cooperatives', 'email')->ignore($participant->email, 'email'),
            ],
            'last_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'designation' => 'nullable|string|max:255',
            'congress_type' => 'nullable|string|max:255',
            'religious_affiliation' => 'nullable|string|max:255',
            'tshirt_size' => 'nullable|string|max:5',
            'is_msp_officer' => 'required|string|max:3',
            'msp_officer_position' => 'nullable|string|max:255',
            'delegate_type' => 'required|string|max:10',
            'event_ids' => 'nullable|array',
            'event_ids.*' => 'exists:events,event_id',
        ]);

        // ✅ Check if the email has changed
        $emailChanged = $participant->email !== $validatedData['email'];

        // Update the participant
        $participant->update($validatedData);
        $participant->events()->sync($request->input('event_ids', []));

        // ✅ If the email has changed, update the linked user's email
        if ($emailChanged && $participant->user_id) {
            $user = User::find($participant->user_id);

            if ($user) {
                // Check if the new email is already used by another user
                $emailExists = User::where('email', $validatedData['email'])
                    ->where('user_id', '!=', $user->user_id) // ✅ Use 'user_id' instead of 'id'
                    ->exists();

                if ($emailExists) {
                    return redirect()->back()->withErrors(['email' => 'This email is already in use by another user.'])->withInput();
                }

                // ✅ Update the user's email
                $user->update(['email' => $validatedData['email']]);
            }
        }

        return redirect()->route('coop.index')->with('success', 'Participant updated successfully.');
    }


    public function destroy($participant_id)
    {
        // Find the participant
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();

        // Get the coop_id before deleting
        $coop_id = $participant->coop_id;

        // Get the associated user
        $user = $participant->user;

        // Delete the participant
        $participant->delete();

        // If a user is associated, delete the user as well
        if ($user) {
            $user->delete();
        }

        // 🧮 Recalculate registration fees for the coop
        $cooperative = Cooperative::where('coop_id', $coop_id)->first();

        if ($cooperative) {
            $registrationFee = 4500;
            $totalParticipants = Participant::where('coop_id', $cooperative->coop_id)->count();

            $freeAmount = 0;
            $cetfRemittance = $cooperative->cetf_remittance ?? 0;

            // MIGS check
            $migsCount = GARegistration::where('coop_id', $cooperative->coop_id)
                ->where('membership_status', 'Migs')
                ->count();

            if ($migsCount >= 1) {
                $freeAmount += 9000;
            }

            // Free per 100k remittance
            $free100kCount = floor($cetfRemittance / 100000);
            $freeAmount += $free100kCount * 4500;

            // Half CETF logic
            if ($cooperative->half_based_cetf && $cetfRemittance >= 50000 && $cetfRemittance < 100000) {
                $freeAmount += 2250;
            }

            $totalRegFee = $totalParticipants * $registrationFee;
            $netRequiredRegFee = $totalRegFee - $freeAmount;

            $regFeePayable = $netRequiredRegFee;
            $regFeePayable -= ($cooperative->less_prereg_payment ?? 0);
            $regFeePayable -= ($cooperative->less_cetf_balance ?? 0);

            $cooperative->total_reg_fee = $totalRegFee;
            $cooperative->net_required_reg_fee = $netRequiredRegFee;
            $cooperative->reg_fee_payable = $regFeePayable;
            $cooperative->save();
        }

        return redirect()->route('coop.index')->with('success', 'Participant and associated user deleted!');
    }



    public function documents()
    {
        // Get the logged-in user's cooperative information
        $cooperative = Auth::user()->cooperative;

        if (!$cooperative) {
            return redirect()->back()->with('error', 'You are not associated with a cooperative.');
        }

        // Check if the cooperative has any uploaded documents
        $hasDocuments = $cooperative->uploadedDocuments()->exists();

        // Pass the cooperative and document existence data to the view
        return view('components.cooperative.documents', compact('cooperative', 'hasDocuments'));
    }


    public function viewDocuments()
    {
        $cooperative = Auth::user()->cooperative;

        if (!$cooperative) {
            return redirect()->back()->with('error', 'You are not registered as a cooperative.');
        }

        $hasDocuments = $cooperative->uploadedDocuments()->exists();

        $documents = UploadedDocument::where('coop_id', $cooperative->coop_id)->get();

        return view('components.cooperative.view_documents', compact('documents', 'hasDocuments'));
    }

    public function storeDocuments(Request $request)
    {
        $request->validate([
            'documents.Financial Statement' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.Resolution for Voting Delegates' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.Deposit Slip for Registration Fee' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.Deposit Slip for CETF Remittance' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.CETF Undertaking' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.Certificate of Candidacy' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',
            'documents.CETF Utilization Invoice' => 'nullable|mimes:jpg,jpeg,png,pdf,xlsx,xls,csv,zip',

        ]);

        $cooperative = Auth::user()->cooperative;

        if (!$cooperative) {
            return response()->json(['success' => false, 'message' => 'You are not registered as a cooperative.'], 403);
        }

        $successMessages = [];

        foreach ($request->file('documents') as $documentType => $file) {
            // Check if the document already exists
            $existingDocument = UploadedDocument::where('coop_id', $cooperative->coop_id)
                ->where('document_type', $documentType)
                ->first();

            if ($existingDocument) {
                // Delete the old file before replacing
                Storage::disk('public')->delete($existingDocument->file_path);
                $existingDocument->delete();
            }

            // Upload and save new file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            UploadedDocument::create([
                'coop_id' => $cooperative->coop_id,
                'document_type' => $documentType,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
            ]);

            $successMessages[] = "$documentType uploaded successfully.";
        }

        return response()->json([
            'success' => true,
            'message' => implode('<br>', $successMessages)
        ]);
    }


    public function viewadminDocuments($coop_id = null)
    {
        // If participant_id is provided, filter documents
        if ($coop_id) {
            $documents = UploadedDocument::where('coop_id', $coop_id)->get();
        } else {
            $documents = UploadedDocument::all(); // Show all documents if no participant is selected
        }

        return view('components.admin.participant.documents', compact('documents', 'coop_id'));
    }

    public function updateDocumentStatus(Request $request, $document_id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Checked,Approved,Rejected',
            'remarks' => 'nullable|string|max:255'
        ]);

        $document = UploadedDocument::findOrFail($document_id);
        $document->status = $request->status;
        $document->remarks = $request->remarks;
        $document->save();

        return back()->with('success', 'Document status and remarks updated successfully.');
    }


    public function updateAllCooperatives()
    {
        (new CooperativeObserver())->updateAllCooperativesMembershipStatus();

        return response()->json(['message' => 'All cooperatives membership status updated successfully.']);
    }


    public function storeDocuments2(Request $request, $id)
    {
        $request->validate([
            // validation rules
        ]);

        // Find the cooperative by its ID
        $cooperative = Cooperative::findOrFail($id);

        $successMessages = [];
        $uploadedFiles = $request->file('documents', []); // Default to empty array if no files

        $markAsDone = $request->input('markAsDone', []);
        foreach ($markAsDone as $documentType => $checked) {
            // Skip if a file was already uploaded for this documentType
            if (isset($uploadedFiles[$documentType])) {
                continue;
            }

            // Check if the document already exists and delete it
            $existingDocument = UploadedDocument::where('coop_id', $cooperative->coop_id)
                ->where('document_type', $documentType)
                ->first();

            if ($existingDocument) {
                Storage::disk('public')->delete($existingDocument->file_path);
                $existingDocument->delete();
                $successMessages[] = "$documentType marked as done and replaced with a blank PDF.";
            }

            // Create a blank PDF (you can customize it more if you want)
            $blankPdfContent = file_get_contents(public_path('blank.pdf')); // Place a template blank.pdf in public/
            $fileName = time() . "_blank_$documentType.pdf";
            $filePath = "documents/$fileName";

            Storage::disk('public')->put($filePath, $blankPdfContent);

            // Save to DB
            UploadedDocument::create([
                'coop_id' => $cooperative->coop_id,
                'document_type' => $documentType,
                'file_name' => "hardcopy_$documentType.pdf",
                'file_path' => $filePath,
                'status' => 'Approved',
                'remarks' => 'Hardcopy',
            ]);

            $successMessages[] = "$documentType marked as done (blank PDF uploaded).";
        }

        $submittedMarkAsDone = array_keys($markAsDone);

        $allDocumentTypes = [
            'Financial Statement',
            'Resolution for Voting delegates',
            'Deposit Slip for Registration Fee',
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization invoice',
        ];

        foreach ($allDocumentTypes as $documentType) {
            if (!in_array($documentType, $submittedMarkAsDone)) {
                $existingDocument = UploadedDocument::where('coop_id', $cooperative->coop_id)
                    ->where('document_type', $documentType)
                    ->where('remarks', 'Hardcopy')
                    ->where('status', 'Approved')
                    ->first();

                if ($existingDocument) {
                    // Change status to Pending or Rejected and update remarks
                    $existingDocument->remarks = null;
                    $existingDocument->status = 'Pending'; // or 'Rejected'
                    $existingDocument->save();

                    $successMessages[] = "$documentType hardcopy remark removed.";
                }
            }
        }

        // Fetch documents and update session after changing status
        $documents = UploadedDocument::where('coop_id', $cooperative->coop_id)->get();
        $documentsWithHardcopy = [];

        foreach ($documents as $document) {
            // Check for hardcopy and approved status to mark checkbox as checked
            if ($document->remarks === 'Hardcopy' && $document->status === 'Approved') {
                $documentsWithHardcopy[$document->document_type] = true;
            } else {
                $documentsWithHardcopy[$document->document_type] = false;
            }
        }

        // Store the updated data in session immediately after status update
        session()->put('documentsWithHardcopy', $documentsWithHardcopy);

        // Handle uploaded files
        foreach ($uploadedFiles as $documentType => $file) {
            if (!$file) {
                continue; // Skip if file is null
            }

            // Check if the document already exists
            $existingDocument = UploadedDocument::where('coop_id', $cooperative->coop_id)
                ->where('document_type', $documentType)
                ->first();

            if ($existingDocument) {
                // Delete the existing document
                Storage::disk('public')->delete($existingDocument->file_path);
                $existingDocument->delete();
                $successMessages[] = "$documentType replaced successfully.";
            }

            // Store the new file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            // Create a new document record
            UploadedDocument::create([
                'coop_id' => $cooperative->coop_id,
                'document_type' => $documentType,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
            ]);

            $successMessages[] = "$documentType uploaded successfully.";
        }

        // Set a unique session key based on the form submitted
        $formKey = $request->input('form_key', 'default_form');
        session()->flash("{$formKey}_success", implode('<br>', $successMessages));

        return redirect()->route('cooperatives.edit', $cooperative->coop_id);
    }
}
