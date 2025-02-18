<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Speaker;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CooperativeController extends Controller
{

    public function index(Request $request)
    {
        $participants = Participant::with(['registration', 'cooperative', 'user']) // Eager load cooperative
            ->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $request->search . '%');
            })->paginate(10);

        return view('dashboard.participant.manage_participant.participant', compact('participants'));
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
        'user_id' => 'nullable|exists:users,user_id',
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
    ]);

    // Store the participant data
    $participant = Participant::create($validatedData);

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

    // Redirect or return a response
    return redirect()->route('coop.index')->with('success', 'Participant registered successfully!');
}

 // Show a specific participant
 public function show($coop_id)
 {
     $participant = Participant::where('coop_id', $coop_id)->firstOrFail();
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
     // Use 'participant_id' for the identifier
     $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
     $participant->update($request->all());

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

      $registrationStatus = $cooperative->registration ? $cooperative->registration->status : 'Pending';
      $successMessages = [];

      foreach ($request->file('documents') as $documentType => $file) {
          $existingDocument = UploadedDocument::where('coop_id', $cooperative->coop_id)
              ->where('document_type', $documentType)
              ->first();

          if ($existingDocument && $registrationStatus === 'Rejected') {
              Storage::disk('public')->delete($existingDocument->file_path);
              $existingDocument->delete();

              $filePath = $file->store('documents', 'public');

              UploadedDocument::create([
                  'coop_id' => $cooperative->coop_id,
                  'document_type' => $documentType,
                  'file_name' => $file->getClientOriginalName(),
                  'file_path' => $filePath,
              ]);

              $successMessages[] = "$documentType uploaded successfully after rejection.";
              continue;
          }

          if ($existingDocument) {
              $successMessages[] = "$documentType has already been uploaded.";
              continue;
          }

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


}
