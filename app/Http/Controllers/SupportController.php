<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CooperativeNotification;
use Illuminate\Support\Facades\Storage;


class SupportController extends Controller
{

    public function support()
    {

        $regions = Cooperative::distinct()->pluck('region', 'region')->sort();

        $totalAttended = EventParticipant::whereNotNull('attendance_datetime')->count();
        $totalParticipants = Participant::count();
        $totalUsers = User::count();
        $totalSpeakers = Speaker::count();
        $totalEvents = Event::count();
        $totalCooperative = Cooperative::count();
        $latestEvent = Event::with('speakers')->orderBy('start_date', 'desc')->first();
        $latestEvents = Event::with('speakers')->orderBy('start_date', 'desc')->take(5)->get();

        // $totalMigsAttended = EventParticipant::whereNotNull('attendance_datetime')
        //     ->whereHas('participant.cooperative.gaRegistration', function ($query) {
        //         $query->where('membership_status', 'Migs');
        //     })
        //     ->distinct('participant_id')
        //     ->count('participant_id');

        $totalMigsParticipants = Participant::whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs');
        })->count();

        $totalNonMigsParticipants = Participant::whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs');
        })->count();

        // Get cooperative IDs that are fully and partially registered
        $fullyRegisteredCoops = GARegistration::where('registration_status', 'Fully Registered')
            ->distinct()->count('coop_id');

        $partiallyRegisteredCoops = GARegistration::where('registration_status', 'Partial Registered')
            ->distinct()->count('coop_id');

        // Count participants based on their cooperative's registration status
        $fullyRegisteredParticipants = Participant::whereIn(
            'coop_id',
            GARegistration::where('registration_status', 'Fully Registered')->pluck('coop_id')
        )->count();

        $partiallyRegisteredParticipants = Participant::whereIn(
            'coop_id',
            GARegistration::where('registration_status', 'Partial Registered')->pluck('coop_id')
        )->count();

        // Registered Coops: Fully or Partially Registered with GARegistration
        $registeredCoops = GARegistration::whereIn('registration_status', ['Fully Registered', 'Partial Registered'])
            ->whereNotNull('coop_id')
            ->distinct()
            ->count('coop_id');
$registeredMigsCoops = GARegistration::where('membership_status', 'Migs')
->whereHas('cooperative.participants')
->distinct()->count('coop_id');

// Count registered NON-MIGS Coops with Participant connection
$registeredNonMigsCoops = GARegistration::where('membership_status', 'Non-migs')
->whereHas('cooperative.participants')
->distinct()->count('coop_id');

$totalCoopAttended = DB::table('participants')
    ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
    ->whereNotNull('event_participant.attendance_datetime') // Ensures the participant attended
    ->distinct('participants.coop_id') // Counts each coop only once
    ->count('participants.coop_id');

$totalMigsAttended = DB::table('participants')
    ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
    ->whereNotNull('event_participant.attendance_datetime') // Ensures the participant attended
    ->whereIn('participants.coop_id', function ($query) {
        $query->select('coop_id')
              ->from('ga_registrations')
              ->where('membership_status', 'Migs');
    })
    ->distinct('participants.coop_id') // Counts MIGS coop only once
    ->count('participants.coop_id');

$totalNonMigsAttended = DB::table('participants')
    ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
    ->whereNotNull('event_participant.attendance_datetime') // Ensures the participant attended
    ->whereIn('participants.coop_id', function ($query) {
        $query->select('coop_id')
              ->from('ga_registrations')
              ->where('membership_status', 'Non-migs');
    })
    ->distinct('participants.coop_id') // Counts Non-MIGS coop only once
    ->count('participants.coop_id');

    $totalVoting = Participant::where('delegate_type', 'Voting')->count();

// Attended Participants with Voting Delegate Type
$totalVotingParticipants = EventParticipant::whereNotNull('attendance_datetime')
    ->whereHas('participant', function ($query) {
        $query->where('delegate_type', 'Voting');  // Only participants with 'voting' delegate type
    })
    ->distinct('participant_id')  // Ensures each participant is counted only once
    ->count('participant_id');

    $events = Event::withCount(['participants' => function ($query) {
        $query->whereNotNull('event_participant.attendance_datetime'); // Specify the table
    }])->get();

        // Registered Participants: Those with non-null coop_id
        $registeredParticipants = Participant::whereNotNull('coop_id')->count();

        return view('dashboard.support.admin', compact(
            'regions',
            'totalParticipants',
            'totalUsers',
            'totalSpeakers',
            'totalEvents',
            'latestEvent',
            'fullyRegisteredCoops',
            'partiallyRegisteredCoops',
            'fullyRegisteredParticipants',
            'partiallyRegisteredParticipants',
            'totalCooperative',
            'totalAttended',
            'totalMigsAttended',
            'totalMigsParticipants',
            'totalNonMigsParticipants',
            'latestEvents',
            'registeredCoops',
            'registeredMigsCoops',
            'registeredNonMigsCoops',
            'totalCoopAttended',
            'totalCoopAttended',
            'totalVoting',
            'totalNonMigsAttended',
            'totalVotingParticipants',
            'events',
            'registeredParticipants'
        ));
    }

    public function supportview(Request $request)
    {
        $search = $request->input('search');
        $filterNoGA = $request->input('filter_no_ga2');
        $limit = $request->input('limit', 10);

        $cooperatives = Cooperative::query();

        // Apply filter for No GA Registration
        if ($filterNoGA === '1') {
            $cooperatives->whereDoesntHave('gaRegistration');
        }

        // Apply search if provided
        if ($search) {
            $cooperatives->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('region', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhereHas('gaRegistration', function ($query) use ($search) {
                        // Check for "No Registration" search
                        if (strtoupper($search) === 'NO REGISTRATION') {
                            $query->whereNull('registration_status')
                                  ->orWhere('registration_status', 'Rejected');
                        } else {
                            $query->where('registration_status', 'LIKE', "%{$search}%")
                                  ->orWhere('membership_status', 'LIKE', "%{$search}%");
                        }
                    });
            });
        }

        // Apply pagination
        $cooperatives = $cooperatives->orderBy('created_at', 'desc')->paginate($limit);

        $emails = $cooperatives->pluck('email')->filter()->implode(',');

        return view('dashboard.support.datatable', compact('cooperatives', 'search', 'emails', 'filterNoGA'));
    }


    public function editProfile3()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard.support.myprofile', compact('user')); // Pass user data to the view
    }


    public function updateProfile3(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',user_id',
            'password' => 'nullable|string|min:6|confirmed', // Only validate if password is provided
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash the new password
        }

        // Update the other fields
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Password will be updated only if filled
            'password' => $user->password ?? $user->password,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile.edit3')->with('success', 'Profile updated successfully!');
    }

    public function show_support($id)
    {
        // Find the cooperative by ID
        $coop = Cooperative::findOrFail($id);

        // Pass the cooperative data to the view
        return view('dashboard.support.view', compact('coop'));
    }

    public function viewsupportDocuments($coop_id = null)
    {
        // If participant_id is provided, filter documents
        if ($coop_id) {
            $documents = UploadedDocument::where('coop_id', $coop_id)->get();
        } else {
            $documents = UploadedDocument::all(); // Show all documents if no participant is selected
        }

        return view('dashboard.support.documents', compact('documents', 'coop_id'));
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

    public function edit($coop_id)
    {
        $coop = Cooperative::findOrFail($coop_id);

        $hasFinancialStatement = UploadedDocument::where('coop_id', $coop->coop_id)
        ->where('document_type', 'Financial Statement')
        ->exists();
        // Check if cooperative has MIGS membership
        $hasMigsRegistration = GARegistration::where('coop_id', $coop->coop_id)
            ->where('membership_status', 'MIGS')
            ->exists();

        // Check if cooperative has an MSP Officer participant
        $hasMspOfficer = Participant::where('coop_id', $coop->coop_id)
            ->where('is_msp_officer', true)
            ->exists();

        $coop->cetf_balance = ($coop->cetf_required ?? 0) - ($coop->total_remittance ?? 0);
        // Check the total remittance
        $totalRemittance = $coop->total_remittance ?? 0;
        $free100kCETF = $totalRemittance >= 100000; // Free 1 pax if remittance >= 100K
        $halfBasedCETF = $totalRemittance >= 50000; // Free 1 pax if remittance >= 50K

        // Get the number of participants
        $numParticipants = $coop->participants()->count();

        // Calculate the number of free participants
        $freeParticipants = 0;
        if ($hasMigsRegistration) {
            $freeParticipants += 2; // Free 2 participants for MIGS
        }
        if ($hasMspOfficer) {
            $freeParticipants += 1;
        }
        if ($free100kCETF) {
            $freeParticipants += 1;
        }
        if ($halfBasedCETF) {
            $numParticipants = max(0, $numParticipants - 1); // Discount 1 participant by 50%
        }

        $paidParticipants = max($numParticipants - $freeParticipants, 0);

        // Calculate total registration fee
        $registrationFee = $coop->registration_fee ?? 0;
        $totalRegFee = $paidParticipants * $registrationFee;

        // Calculate registration fee payable
        $netRequiredRegFee = $coop->net_required_reg_fee ?? 0;
        $lessPreregPayment = $coop->less_prereg_payment ?? 0;
        $lessCetfBalance = $coop->less_cetf_balance ?? 0;

        $regFeePayable = max(0, $netRequiredRegFee - ($lessPreregPayment + $lessCetfBalance));

        // Store values in the model
        $coop->total_reg_fee = $totalRegFee;
        $coop->reg_fee_payable = $regFeePayable;

        return view('dashboard.support.edit', compact(
            'coop', 'hasMigsRegistration', 'hasMspOfficer', 'free100kCETF', 'halfBasedCETF', 'hasFinancialStatement'
        ));
    }



    public function update(Request $request, $coop_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'general_manager_ceo' => 'nullable|string|max:255',
            'bod_chairperson' => 'nullable|string|max:255',
            'coop_identification_no' => 'nullable|string|max:255',
            'region' => [
                'required',
                Rule::in([
                    'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
                    'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
                    'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST','LUZON'
                ]),
            ],
            'phone_number' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email'),
                Rule::unique('cooperatives', 'email')->ignore($coop_id, 'coop_id'),
            ],
            'tin' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            // 'fs_status' => ['nullable', Rule::in(['yes', 'no'])],
            // 'delinquent' => ['nullable', Rule::in(['yes', 'no'])],

            // // Numeric Fields
            // 'total_asset' => 'nullable|numeric|min:0',
            // 'loan_balance' => 'nullable|numeric|min:0',
            // 'total_overdue' => 'nullable|numeric|min:0',
            // 'time_deposit' => 'nullable|numeric|min:0',
            // 'accounts_receivable' => 'nullable|numeric|min:0',
            // 'savings' => 'nullable|numeric|min:0',
            // 'net_surplus' => 'nullable|numeric|min:0',
            // 'cetf_due_to_apex' => 'nullable|numeric|min:0',
            // 'additional_cetf' => 'nullable|numeric|min:0',
            // 'cetf_undertaking' => 'nullable|numeric|min:0',
            // 'total_income' => 'nullable|numeric|min:0',
            // 'cetf_remittance' => 'nullable|numeric|min:0',
            // 'cetf_required' => 'nullable|numeric|min:0',
            // 'cetf_balance' => 'nullable|numeric',
            // 'total_remittance' => 'nullable|numeric|min:0',
            // 'net_required_reg_fee' => 'nullable|numeric|min:0',
            // 'total_reg_fee' => 'nullable|numeric|min:0',
            // 'share_capital_balance' => 'nullable|numeric|min:0',
            // 'less_prereg_payment' => 'nullable|numeric|min:0',
            // 'less_cetf_balance' => 'nullable|numeric|min:0',

            // // Other Fields
            // 'full_cetf_remitted' => ['nullable', Rule::in(['yes', 'no'])],
            // 'registration_date_paid' => 'nullable|date',
            // 'registration_fee' => 'nullable|numeric|min:0',
            'ga_remark' => 'nullable|string|max:255',
            // 'no_of_entitled_votes' => 'nullable|integer|min:0',
            // 'services_availed' => 'nullable|array',
            // 'services_availed.*' => 'string|max:255',
        ]);

        // Convert numeric values (remove commas)
        // $numericFields = [
        //     'total_asset', 'loan_balance', 'total_overdue', 'time_deposit',
        //     'accounts_receivable', 'savings', 'net_surplus', 'cetf_due_to_apex',
        //     'additional_cetf', 'cetf_undertaking', 'total_income', 'cetf_remittance',
        //     'cetf_required', 'cetf_balance', 'total_remittance', 'net_required_reg_fee',
        //     'total_reg_fee', 'share_capital_balance', 'registration_fee',
        //     'less_prereg_payment', 'less_cetf_balance'
        // ];

        // foreach ($numericFields as $field) {
        //     $validated[$field] = $request->$field ? (float) str_replace(',', '', $request->$field) : null;
        // }

        // $netRequiredRegFee = $validated['net_required_reg_fee'] ?? 0;
        // $lessPreregPayment = $validated['less_prereg_payment'] ?? 0;
        // $lessCetfBalance = $validated['less_cetf_balance'] ?? 0;


        // $validated['reg_fee_payable'] = max(0, $netRequiredRegFee - ($lessPreregPayment + $lessCetfBalance));

        // // ✅ Calculate `no_of_entitled_votes`
        // $share_capital = $validated['share_capital_balance'] ?? 0;
        // $votes = 0;

        // if ($share_capital >= 100000) {
        //     $votes += floor($share_capital / 100000);
        // }

        // $validated['cetf_balance'] = ($validated['cetf_required'] ?? 0) - ($validated['total_remittance'] ?? 0);

        // $remaining = $share_capital % 100000;

        // while ($remaining >= 25000) {
        //     if ($remaining >= 75000) {
        //         $votes += 3;
        //         $remaining -= 75000;
        //     } elseif ($remaining >= 50000) {
        //         $votes += 2;
        //         $remaining -= 50000;
        //     } elseif ($remaining >= 25000) {
        //         $votes += 1;
        //         $remaining -= 25000;
        //     }
        // }

        // $validated['no_of_entitled_votes'] = min($votes, 5);

        // // Convert services_availed array to JSON
        // $validated['services_availed'] = isset($request->services_availed)
        //     ? json_encode($request->services_availed)
        //     : json_encode([]);

        // ✅ Update the cooperative
        $coop = Cooperative::findOrFail($coop_id);
        $coop->update($validated);

        // ✅ Update linked user
        $user = User::where('coop_id', $coop->coop_id)->first();

        if ($user) {
            $currentUserEmail = strtolower(trim($user->email));
            $newCoopEmail = strtolower(trim($coop->email));

            if ($currentUserEmail !== $newCoopEmail) {
                $emailExists = User::where('email', $coop->email)
                    ->where('user_id', '!=', $user->user_id)
                    ->exists();

                if ($emailExists) {
                    return redirect()->back()->withErrors(['email' => 'The email is already used by another user.']);
                }

                $user->update([
                    'name' => $coop->contact_person,
                    'email' => $coop->email,
                ]);
            } else {
                $user->update([
                    'name' => $coop->contact_person,
                ]);
            }
        }

        return redirect()->route('supportview')->with('success', 'Cooperative updated successfully!');
    }

    public function storeDocuments3(Request $request, $id)
  {
    $request->validate([
       'documents.Financial Statement' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.Resolution for Voting Delegates' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.Deposit Slip for Registration Fee' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.Deposit Slip for CETF Remittance' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.CETF Undertaking' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.Certificate of Candidacy' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',
'documents.CETF Utilization Invoice' => 'nullable|mimes:jpg,jpeg,png,pdf,xls,xlsx,csv',

    ]);

      // Find the cooperative by its ID
      $cooperative = Cooperative::findOrFail($id);

      $successMessages = [];
      $uploadedFiles = $request->file('documents', []); // Default to empty array if no files

      if (empty($uploadedFiles)) {
          return redirect()->route('support.cooperatives.edit', $cooperative->coop_id)
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

      return redirect()->route('support.cooperatives.edit', $cooperative->coop_id);
  }

  public function resendEmail3($userId)
  {
      $user = User::where('user_id', $userId)->firstOrFail();

      // Generate a temporary password
      $temporaryPassword = Str::random(6);

      // Update the user's password in the database
      $user->password = Hash::make($temporaryPassword);
      $user->save();

      // Send email with the new password
      Mail::to($user->email)->queue(new ParticipantCreated($user, $temporaryPassword));

      return response()->json([
          'success' => true,
          'message' => 'A new password has been generated and sent to the user.'
      ]);
  }

  public function sendNotificationsupport($coopId)
{
    try {
        \Log::info('Notification request received for Coop ID: ' . $coopId);

        // Find the cooperative by ID
        $coop = Cooperative::findOrFail($coopId);
        \Log::info('Found cooperative: ' . $coop->name . ' with email: ' . $coop->email);

        // Get the latest event for the cooperative
        $event = Event::latest()->first();

        // Fetch GA Registration details
        $gaRegistration = GARegistration::where('coop_id', $coopId)->latest()->first();

        // Fetch only users with role "cooperative" belonging to the current cooperative
        $users = User::where('coop_id', $coop->coop_id)
            ->where('role', 'cooperative')
            ->get();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                // Generate password using the first letter of each word in the cooperative name
                $acronym = strtoupper(implode('', array_map(fn($word) => $word[0], explode(' ', trim($coop->name)))));
                $sanitizedPassword = $acronym . 'GA2025';

                // Update user password
                $user->password = Hash::make($sanitizedPassword);
                $user->save();

                \Log::info("New password set for user: {$user->email} -> {$sanitizedPassword}");
            }

            // Send notification email
            Mail::to($coop->email)->queue(new CooperativeNotification($coop, $event, $gaRegistration, $users, $sanitizedPassword));
            \Log::info("Notification sent to: {$coop->email}");

            return redirect()->route('supportview')->with('success', 'Notification sent with updated password!');
        } else {
            \Log::info("Skipped cooperative: {$coop->name} (No cooperative users found)");
        }

        return redirect()->route('supportview')->with('success', 'Notification sent to the cooperative!');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        \Log::error('Cooperative not found: ' . $e->getMessage());
        return back()->with('error', 'Cooperative not found.');
    } catch (\Exception $e) {
        \Log::error('Error sending notification: ' . $e->getMessage());
        return back()->with('error', 'Error sending notification: ' . $e->getMessage());
    }
}


  public function supportregister()
  {
      return view('dashboard.support.add');
  }

  public function supportstoreCooperative(Request $request)
  {
      // Validate the incoming data
      $request->validate([
          'name' => 'required|string|max:255',
          'contact_person' => 'required|string|max:255',
          'type' => 'required|string|max:255',
          'address' => 'required|string|max:255',
          'region' => 'required|string|max:255|in:Region I,Region II,Region III,Region IV-A,Region IV-B,Region V,Region VI,Region VII,Region VIII,Region IX,Region X,Region XI,Region XII,Region XIII,NCR,CAR,BARMM,ZBST,LUZON',
          'phone_number' => 'required|string|max:20',
          'email' => 'required|email|unique:cooperatives,email',
          'tin' => 'required|string|max:255',
          'coop_identification_no' => 'nullable|string|max:255',
          'bod_chairperson' => 'nullable|string|max:255',
          'general_manager_ceo' => 'nullable|string|max:255',

      ]);



      $cooperative = Cooperative::create([
          'name' => $request->name,
          'contact_person' => $request->contact_person,
          'type' => $request->type,
          'address' => $request->address,
          'region' => $request->region,
          'phone_number' => $request->phone_number,
          'email' => $request->email,
          'tin' => $request->tin,
      ]);


      $words = preg_split('/\s+/', trim($cooperative->name));
      $acronym = '';
      foreach ($words as $word) {
          $acronym .= strtoupper($word[0]);
      }

      $sanitizedPassword = $acronym . 'GA2025';

      // Create the user account
      User::create([
          'name' => $cooperative->contact_person,
          'coop_id' => $cooperative->coop_id,
          'email' => $cooperative->email,
          'password' => Hash::make($sanitizedPassword),
          'role' => 'cooperative',
      ]);

      return response()->json([
          'success' => 'Cooperative and User registered successfully!',
          'generated_password' => $sanitizedPassword,
      ]);
  }

  public function participant_list(Request $request)
  {
      $perPage = $request->input('limit', 5);

      $query = Participant::with(['registration', 'cooperative', 'user']);

      if ($request->search) {
          $query->where('first_name', 'like', '%' . $request->search . '%')
              ->orWhere('last_name', 'like', '%' . $request->search . '%')
              ->orWhere('middle_name', 'like', '%' . $request->search . '%')
              ->orWhere('designation', 'like', '%' . $request->search . '%')
              ->orWhereHas('user', function ($userQuery) use ($request) {
                  $userQuery->where('name', 'like', '%' . $request->search . '%');
              })
              ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                  $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
              });
      }

      if ($request->has('sort_by')) {
          $sortBy = $request->sort_by;
          $sortOrder = $request->sort_order === 'desc' ? 'desc' : 'asc';

          if (in_array($sortBy, ['first_name', 'last_name', 'middle_name', 'designation'])) {
              $query->orderBy($sortBy, $sortOrder);
          } elseif ($sortBy === 'cooperative') {
              $query->join('cooperatives', 'participants.cooperative_id', '=', 'cooperatives.id')
                  ->orderBy('cooperatives.name', $sortOrder);
          } elseif ($sortBy === 'user') {
              $query->join('users', 'participants.user_id', '=', 'users.id')
                  ->orderBy('users.name', $sortOrder);
          }
      }

      $participants = $query->paginate($perPage);

      return view('dashboard.support.participant', compact('participants'));
  }

  public function show($participant_id)
  {
      $participant = Participant::with('events')->where('participant_id', $participant_id)->firstOrFail();
      $events = Event::all();

      return view('dashboard.support.viewparticipant', compact('participant', 'events'));
  }

  public function scanQR(Request $request)
  {
      $participantId = $request->query('participant_id');
      $eventId = $request->query('event_id');

      $participant = Participant::find($participantId);
      if (!$participant) {
          return response()->json(['error' => 'Participant not found.'], 404);
      }

      $event = Event::find($eventId);
      if (!$event) {
          return response()->json(['error' => 'Event not found.'], 404);
      }

      $gaRegistration = GARegistration::where('coop_id', $participant->coop_id)->first();

      if (!$gaRegistration || $gaRegistration->registration_status === 'Partial Registered' || $gaRegistration->registration_status === null) {
          return response()->json(['error' => 'Participant cannot be scanned. GA registration is incomplete.'], 403);
      }

      // Check if participant is registered in this congress (event)
      $isRegisteredInEvent = $participant->events()
          ->where('event_participant.event_id', $eventId) // Explicitly use event_participant.event_id
          ->exists();

      if (!$isRegisteredInEvent) {
          return response()->json(['error' => 'Participant is not added in this congress.'], 403);
      }

      // Check if attendance is already recorded
      $existingAttendance = EventParticipant::where('event_id', $eventId)
          ->where('participant_id', $participantId)
          ->whereNotNull('attendance_datetime')
          ->first();

      if ($existingAttendance) {
          return response()->json(['error' => 'Attendance already recorded for this participant.'], 409);
      }

      // Record attendance
      $attendance = EventParticipant::updateOrCreate(
          [
              'event_id' => $eventId,
              'participant_id' => $participantId,
          ],
          [
              'attendance_datetime' => now(),
          ]
      );

      return response()->json(['success' => 'Attendance recorded successfully!', 'participant' => $participant]);
  }

}
