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
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CooperativeController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $cooperative = $user->cooperative;

        $totalParticipants = $cooperative ? Participant::where('coop_id', $cooperative->coop_id)->count() : 0;
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
            ->paginate($perPage);

        return view('dashboard.participant.manage_participant.participant', compact('participants', 'totalParticipants'));
    }



    public function coopparticipantadd()
    {
        $events = Event::all();
        $cooperatives = Cooperative::all();
        $users = User::whereDoesntHave('cooperative')
                    ->where('role', 'cooperative') // Filter by role
                    ->get();

        return view('dashboard.participant.manage_participant.add', compact('cooperatives', 'users', 'events'));
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

            // $response = Http::get('https://api.qrserver.com/v1/create-qr-code/', [
            //     'data' => $qrData,
            //     'size' => '200x200'
            // ]);

            $response = Http::timeout(30)->get('https://api.qrserver.com/v1/create-qr-code/', [
                'data' => $qrData,
                'size' => '200x200'
            ]);


            if (!$response->successful()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to generate QR code.'
                ], 500);
            }

            $path = 'qrcodes/participant_' . $participant->coop_id . '.png';
            Storage::disk('public')->put($path, $response->body());

            $participant->qr_code = $path;
            $participant->save();

            if ($request->has('event_ids')) {
                $participant->events()->attach($request->input('event_ids'));
            }

            try {
                Mail::to($user->email)->queue(new ParticipantCreated($user, $generatedPassword));
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Email sending failed: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email. Please try again.'
                ], 500);
            }

            DB::commit();

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
     return view('dashboard.participant.manage_participant.view', compact('participant'));
 }

 public function edit($participant_id)
 {
     $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
     $cooperatives = Cooperative::all(); // Fetch all cooperatives

     return view('dashboard.participant.manage_participant.edit', compact('participant', 'cooperatives'));
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
     ]);

     // ✅ Check if the email has changed
     $emailChanged = $participant->email !== $validatedData['email'];

     // Update the participant
     $participant->update($validatedData);

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
        // Use 'participant_id' for the identifier
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        $participant->delete();

      return redirect()->route('coop.index')->with('success', 'Deleted!');
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
        return view('dashboard.participant.documents', compact('cooperative', 'hasDocuments'));
    }


    public function viewDocuments()
    {
        $cooperative = Auth::user()->cooperative;

        if (!$cooperative) {
            return redirect()->back()->with('error', 'You are not registered as a cooperative.');
        }

        $hasDocuments = $cooperative->uploadedDocuments()->exists();

        $documents = UploadedDocument::where('coop_id', $cooperative->coop_id)->get();

        return view('dashboard.participant.view_documents', compact('documents', 'hasDocuments'));
    }

    public function storeDocuments(Request $request)
    {
        $request->validate([
            'documents.Financial Statement' => 'mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Resolution for Voting Delegates' => 'mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Deposit Slip for Registration Fee' => 'mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Deposit Slip for CETF Remittance' => 'mimes:jpg,jpeg,png,pdf|max:2048',
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
            $filePath = $file->store('documents', 'public');

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

      return view('dashboard.admin.participant.documents', compact('documents', 'coop_id'));
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


  public function updateStatus(Request $request, $coop_id)
  {
      // Validate inputs
      $request->validate([
          'registration_status' => 'nullable|in:Partial Registered,Fully Registered,Rejected',
          'membership_status' => 'nullable|in:Non-migs,Migs',
      ]);

      // Find or create GA Registration for the Cooperative
      $gaRegistration = GARegistration::firstOrCreate(
          ['coop_id' => $coop_id],
          ['participant_id' => null] // Ensure participant_id is handled
      );

      // Update only if values are provided
      if ($request->filled('registration_status')) {
          $gaRegistration->registration_status = $request->registration_status;
      }
      if ($request->filled('membership_status')) {
          $gaRegistration->membership_status = $request->membership_status;
      }

      $gaRegistration->save();

      return back()->with('success', 'GA Registration status updated successfully.');
  }

  public function storeDocuments2(Request $request, $id)
  {
      $request->validate([
          'documents.Financial Statement' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.Resolution for Voting Delegates' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.Deposit Slip for Registration Fee' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.Deposit Slip for CETF Remittance' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.CETF Undertaking' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.Certificate of Candidacy' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
          'documents.CETF Utilization Invoice' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
      ]);

      // Find the cooperative by its ID
      $cooperative = Cooperative::findOrFail($id);

      $successMessages = [];
      $uploadedFiles = $request->file('documents', []); // Default to empty array if no files

      if (empty($uploadedFiles)) {
          return redirect()->route('cooperatives.edit', $cooperative->coop_id)
              ->with('error', 'No files were uploaded.');
      }

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
          $filePath = $file->store('documents', 'public');

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
