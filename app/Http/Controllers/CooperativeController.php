<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Speaker;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use Illuminate\Validation\Rule;
use App\Mail\ParticipantCreated;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CooperativeController extends Controller
{

    public function index(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the cooperative of the logged-in user
        $cooperative = $user->cooperative;

        // Get total participants for the cooperative
        $totalParticipants = $cooperative ? $cooperative->participants()->count() : 0;

        // Fetch participants with filtering
        $participants = Participant::with(['registration', 'cooperative', 'user'])
            ->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                    ->orWhere('designation', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                        $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
                    });
            })
            ->paginate(10);

        return view('dashboard.participant.manage_participant.participant', compact('participants', 'totalParticipants'));
    }


    public function coopparticipantadd()
    {
        $cooperatives = Cooperative::all();
        $users = User::whereDoesntHave('cooperative')
                    ->where('role', 'cooperative') // Filter by role
                    ->get();

        return view('dashboard.participant.manage_participant.add', compact('cooperatives', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:participants,email|unique:cooperatives,email',
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

        // Get logged-in user's coop_id
        $validatedData['coop_id'] = Auth::user()->coop_id;

        // Store the participant data
        $participant = Participant::create($validatedData);

        // Generate a unique password
        $generatedPassword = Str::random(12);

        // Create a user linked to the participant
        $user = User::create([
            'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'coop_id' => $validatedData['coop_id'],
            'email' => $validatedData['email'],
            'password' => Hash::make($generatedPassword),
            'role' => 'participant',
        ]);

        // Assign user_id to the participant
        $participant->user_id = $user->user_id;
        $participant->save();

        // Send email notification
        Mail::to($user->email)->send(new ParticipantCreated($user, $generatedPassword));

        // Generate QR code data (e.g., a URL to their profile page)
        $qrData = route('adminDashboard', ['coop_id' => $participant->coop_id]); // Adjust this route as needed

        // Call the external QR code API
        $response = Http::get('https://api.qrserver.com/v1/create-qr-code/', [
            'data' => $qrData,
            'size' => '200x200' // You can adjust the size here
        ]);

        // Check if the QR code generation is successful
        if ($response->successful()) {
            // Save the QR code image
            $path = 'qrcodes/participant_' . $participant->coop_id . '.png';
            Storage::disk('public')->put($path, $response->body());

            // Optionally, save the QR code path to the participant
            $participant->qr_code = $path;
            $participant->save();
        } else {
            // Handle failure if the QR code generation fails
            return redirect()->route('coop.index')->with('error', 'Failed to generate QR code.');
        }

        return redirect()->route('coop.index')->with('success', 'Participant registered and user account created successfully!');
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

    // Validate the form data, ensuring email is unique except for this participant
    $validatedData = $request->validate([
        'coop_id' => 'required|exists:cooperatives,coop_id',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('participants', 'email')->ignore($participant->participant_id, 'participant_id'),
            Rule::unique('cooperatives', 'email'),
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

    // Update the participant
    $participant->update($validatedData);

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
            'documents.Financial Statement' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Resolution for Voting Delegates' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Deposit Slip for Registration Fee' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'documents.Deposit Slip for CETF Remittance' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
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

}
