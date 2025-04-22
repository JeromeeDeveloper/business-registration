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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ParticipantController extends Controller
{
    // Display a listing of participants
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 5); // Default to 5 entries per page

        $query = Participant::with(['registration', 'cooperative', 'user']);

        // Search functionality
        if ($request->search) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                ->orWhere('designation', 'like', '%' . $request->search . '%')
                ->orWhere('delegate_type', 'like', '%' . $request->search . '%')
                ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                    $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
                });
        }

        // Sorting functionality
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

        // Load participants with user and retrieve stored password (if stored)
        $participants = $query->paginate($perPage);

        return view('components.admin.participant.participant', compact('participants'));
    }

    public function resendEmail($userId)
    {
        $user = User::where('user_id', $userId)->firstOrFail();

        // Generate a temporary password
        $temporaryPassword = Str::random(6);

        // Update the user's password in the database
        $user->password = Hash::make($temporaryPassword);
        $user->save();

        // Send email with the new password
        // Mail::to($user->email)->queue(new ParticipantCreated($user, $temporaryPassword));
        SendParticipantEmail::dispatch($user, $temporaryPassword);

        return response()->json([
            'success' => true,
            'message' => 'A new password has been generated and sent to the user.'
        ]);
    }

    public function resendEmail2($userId)
    {
        $user = User::where('user_id', $userId)->firstOrFail();

        // Generate a temporary password
        $temporaryPassword = Str::random(6);

        // Update the user's password in the database
        $user->password = Hash::make($temporaryPassword);
        $user->save();

        // Send email with the new password
        // Mail::to($user->email)->queue(new ParticipantCreated($user, $temporaryPassword));
        SendParticipantEmail::dispatch($user, $temporaryPassword);
        return response()->json([
            'success' => true,
            'message' => 'A new password has been generated and sent to the user.'
        ]);
    }


    public function participantadd()
    {
        $events = Event::all();
        $cooperatives = Cooperative::all();
        $users = User::whereDoesntHave('participant')
                    ->where('role', 'participant')
                    ->get();

        // Event limits and names
        $eventLimits = [
            14 => ['name' => 'Gender Congress', 'limit' => 350],
            15 => ['name' => 'Youth Congress', 'limit' => 150],
            18 => ['name' => 'Education Committee Forum', 'limit' => 300],
            13 => ['name' => 'CEOs/Manager Congress', 'limit' => 500],
        ];

        $eventStatus = [];

        foreach ($eventLimits as $eventId => $data) {
            $count = EventParticipant::where('event_id', $eventId)->count();
            $eventStatus[$eventId] = [
                'name' => $data['name'],
                'total' => $data['limit'],
                'count' => $count,
                'remaining' => max(0, $data['limit'] - $count),
                'full' => $count >= $data['limit'],
            ];
        }

        return view('components.admin.participant.add', compact(
            'cooperatives',
            'users',
            'events',
            'eventStatus'
        ));
    }



public function generateId($id)
{
    $participant = Participant::findOrFail($id);
    return view('components.admin.participant.id', compact('participant'));
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'coop_id' => 'required|exists:cooperatives,coop_id',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'email' => 'required|email|unique:participants,email|unique:users,email|unique:cooperatives,email',
        'last_name' => 'required|string|max:255',
        'nickname' => 'nullable|string|max:255',
        'gender' => 'required|string|max:255',
        'reference_number' => 'unique:participants,reference_number',
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

    do {
        $referenceNumber = Str::upper(Str::random(5));
    } while (Participant::where('reference_number', $referenceNumber)->exists());

    $validatedData['reference_number'] = $referenceNumber;

    $participant = Participant::create($validatedData);

    if ($request->has('event_ids')) {
        $participant->events()->sync($request->input('event_ids'));
    }

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

    // Mail::to($user->email)->queue(new ParticipantCreated($user, $generatedPassword));
    SendParticipantEmail::dispatch($user, $generatedPassword);
    $qrData = route('adminDashboard', ['coop_id' => $participant->coop_id]);

    $response = Http::timeout(30)->get('https://api.qrserver.com/v1/create-qr-code/', [
        'data' => $qrData,
        'size' => '200x200'
    ]);


    if ($response->successful()) {
        $path = 'qrcodes/participant_' . $participant->coop_id . '.png';
        Storage::disk('public')->put($path, $response->body());

        $participant->qr_code = $path;
        $participant->save();
    } else {
        return redirect()->route('participants.index')->with('error', 'Failed to generate QR code.');
    }

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



    return redirect()->route('participants.index')->with('success', 'Participant registered and user account created successfully!');
}

    // Show a specific participant
    public function show($participant_id)
{
    $participant = Participant::with('events')->where('participant_id', $participant_id)->firstOrFail();
    $events = Event::all(); // ✅ Fetch all congress types

    return view('components.admin.participant.view', compact('participant', 'events'));
}



   // Show the form for editing a participant
   public function edit($participant_id)
   {
       $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
       $cooperatives = Cooperative::all();
       $events = Event::all();

       // Define event limits and names
       $eventLimits = [
           14 => ['name' => 'Gender Congress', 'limit' => 350],
           15 => ['name' => 'Youth Congress', 'limit' => 150],
           18 => ['name' => 'Education Committee Forum', 'limit' => 300],
           13 => ['name' => 'CEOs/Manager Congress', 'limit' => 500],
       ];

       $eventStatus = [];

       foreach ($eventLimits as $eventId => $data) {
           $count = EventParticipant::where('event_id', $eventId)->count();
           $eventStatus[$eventId] = [
               'name' => $data['name'],
               'total' => $data['limit'],
               'count' => $count,
               'remaining' => max(0, $data['limit'] - $count),
               'full' => $count >= $data['limit'],
           ];
       }

       return view('components.admin.participant.edit', compact(
           'participant',
           'cooperatives',
           'events',
           'eventStatus'
       ));
   }




    // Update the specified participant
    public function update(Request $request, $participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
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
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email')->ignore($participant->participant_id, 'participant_id'),
                Rule::unique('users', 'email')->ignore($participant->user_id, 'user_id'),
                function ($attribute, $value, $fail) use ($participant) {
                    $existsInCooperatives = DB::table('cooperatives')
                        ->where('email', $value)
                        ->where('coop_id', '!=', $participant->coop_id)
                        ->exists();

                    if ($existsInCooperatives) {
                        $fail('The email has already been taken in another cooperative record.');
                    }
                }
            ],
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'event_ids' => 'nullable|array',
            'event_ids.*' => 'exists:events,event_id',
        ]);

        $participant->update($validatedData);
        $participant->events()->sync($request->input('event_ids', []));

        if ($participant->user_id) {
            $user = User::find($participant->user_id);

            if ($user && $user->email !== $validatedData['email']) {
                $emailExists = User::where('email', $validatedData['email'])
                    ->where('user_id', '!=', $user->user_id)
                    ->exists();

                if ($emailExists) {
                    return redirect()->back()->withErrors(['email' => 'This email is already in use by another user.'])->withInput();
                }

                $user->update([
                    'email' => $validatedData['email'],
                ]);
            }
        }

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }



    // Remove the specified participant
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

        return redirect()->route('participants.index')->with('success', 'Participant and associated user deleted!');
    }



      // Show the document upload form
      public function documents()
      {
          // Get the logged-in user's cooperative information
          $cooperative = Auth::user()->cooperative;

          if (!$cooperative) {
              return redirect()->back()->with('error', 'You are not associated with a cooperative.');
          }

          // Pass the cooperative data to the view
          return view('components.cooperative.documents', compact('cooperative'));
      }


      public function storeDocuments(Request $request)
      {
          $request->validate([
             'documents.Financial Statement' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.Resolution for Voting Delegates' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.Deposit Slip for Registration Fee' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.Deposit Slip for CETF Remittance' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.CETF Undertaking' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.Certificate of Candidacy' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',
'documents.CETF Utilization Invoice' => 'nullable|mimes:jpg,jpeg,png,pdf,zip',

          ]);

          $participant = Auth::user()->participant;

          if (!$participant) {
              return response()->json(['success' => false, 'message' => 'You are not registered as a participant.'], 403);
          }

          $registrationStatus = $participant->registration ? $participant->registration->status : 'Pending';
          $successMessages = [];

          foreach ($request->file('documents') as $documentType => $file) {
              $existingDocument = UploadedDocument::where('participant_id', $participant->participant_id)
                  ->where('document_type', $documentType)
                  ->first();

              if ($existingDocument && $registrationStatus === 'Rejected') {
                  // Delete the old file before replacing
                  Storage::disk('public')->delete($existingDocument->file_path);
                  $existingDocument->delete();
              }

              if ($existingDocument && $registrationStatus !== 'Rejected') {
                  $successMessages[] = "$documentType has already been uploaded.";
                  continue;
              }

              // Preserve original filename and prevent overwriting by adding timestamp
              $fileName = time() . '_' . $file->getClientOriginalName();
              $filePath = $file->storeAs('documents', $fileName, 'public');

              UploadedDocument::create([
                  'participant_id' => $participant->participant_id,
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



      public function viewDocuments()
      {
          $participant = Auth::user()->participant;

          if (!$participant) {
              return redirect()->back()->with('error', 'You are not registered as a participant.');
          }

          $documents = UploadedDocument::where('participant_id', $participant->participant_id)->get();

          return view('components.cooperative.view_documents', compact('documents'));
      }

      public function userDocuments()
    {
        $user = auth()->user();
        $participant = $user->participant;

        if (!$participant) {
            return redirect()->back()->with('error', 'No participant record found.');
        }

        $documents = $participant->uploadedDocuments; // Fetch all documents

        return view('components.cooperative.dashboard', compact('documents'));
    }

    // public function viewadminDocuments($participant_id = null)
    // {
    //     // If participant_id is provided, filter documents
    //     if ($participant_id) {
    //         $documents = UploadedDocument::where('participant_id', $participant_id)->get();
    //     } else {
    //         $documents = UploadedDocument::all(); // Show all documents if no participant is selected
    //     }

    //     return view('components.admin.participant.documents', compact('documents', 'participant_id'));
    // }

    public function speakerlist(Request $request)
    {
        $search = $request->input('search');

        $speakers = Speaker::with('event') // Eager load event details
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('topic', 'like', '%' . $search . '%')
                    ->orWhereHas('event', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('name', 'asc')
            ->paginate(5); // Ensure pagination is applied

        return view('components.cooperative.speakers', compact('speakers', 'search'));
    }

    public function approve(Request $request, Participant $participant)
{
    // Ensure the participant has uploaded documents
    if (!$participant->uploadedDocuments()->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Participant has no uploaded documents.'
        ], 400);
    }

    // Determine if the participant has an existing registration
    $registration = $participant->registration;

    // Get the requested status (default to 'Confirmed' if not provided)
    $status = $request->input('status', 'Confirmed');

    // If no registration exists, create one
    if (!$registration) {
        $registration = GARegistration::create([
            'participant_id' => $participant->participant_id,
            'coop_id' => $participant->coop_id, // Ensure this field is available
            'status' => $status, // Set the provided status (Confirmed/Rejected)
            'delegate_type' => 'Voting', // Default delegate type (change if needed)
            'date_submitted' => now(), // Set current timestamp
        ]);
    } else {
        // If registration exists, update the status
        $registration->status = $status;
        $registration->save();
    }

    return response()->json([
        'success' => true,
        'message' => "Participant status updated to $status."
    ]);
}

public function editProfile()
{
    $user = Auth::user(); // Get the authenticated user
    return view('components.cooperative.profile.cooperativeprofile', compact('user')); // Pass user data to the view
}

public function updateProfile(Request $request)
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

    // Update the user details
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $user->password ?? $user->password,
    ]);

    // Update the cooperative email to the same as the user email
    $cooperative = $user->cooperative; // Get the associated cooperative
    if ($cooperative) {
        $cooperative->update([

            'email' => $request->email, // Update the cooperative email to the new user email
            'contact_person' => $request->name, // Update the cooperative contact_person to the user's name
        ]);
    }

    // Redirect back with a success message
    return redirect()->route('participant.profile.edit')->with('success', 'Profile updated successfully and cooperative email synced!');
}


}
