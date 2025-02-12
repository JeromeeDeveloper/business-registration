<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    // Display a listing of participants
    public function index(Request $request)
    {
        $participants = Participant::when($request->search, function($query) use ($request) {
            return $query->where('first_name', 'like', '%' . $request->search . '%')
                         ->orWhere('last_name', 'like', '%' . $request->search . '%')
                         ->orWhere('middle_name', 'like', '%' . $request->search . '%');
        })->paginate(10);  // or use another number based on your preference for per-page items

        return view('dashboard.admin.participant.participant', compact('participants'));
    }

    public function participantadd()
    {
        $cooperatives = Cooperative::all();
        $users = User::whereDoesntHave('participant')
                    ->where('role', 'participant') // Filter by role
                    ->get();

        return view('dashboard.admin.participant.add', compact('cooperatives', 'users'));
    }


    public function store(Request $request)
    {

        // Validate the form data
        $validatedData = $request->validate([
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'user_id' => 'required|exists:users,user_id',
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
        Participant::create($validatedData);

        return redirect()->route('participants.index')->with('success', 'Participant registered successfully!');
    }

    // Show a specific participant
    public function show($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('dashboard.admin.participant.view', compact('participant'));
    }


    // Show the form for editing a participant
    public function edit($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('dashboard.admin.participant.edit', compact('participant')); // ✅ Corrected path
    }

    // Update the specified participant
    public function update(Request $request, $participant_id)
    {
        // Use 'participant_id' for the identifier
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        $participant->update($request->all());

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }

    // Remove the specified participant
    public function destroy($participant_id)
    {
        // Use 'participant_id' for the identifier
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        $participant->delete();

        return redirect()->route('participants.index')->with('success', 'Deleted!');
    }

      // Show the document upload form
      public function documents()
      {
          // Get the logged-in user's participant information
          $participant = Auth::user()->participant;

          if (!$participant) {
              return redirect()->back()->with('error', 'You are not registered as a participant.');
          }

          return view('dashboard.participant.documents', compact('participant'));
      }

      // Store uploaded documents
      public function storeDocuments(Request $request)
      {
          $request->validate([
              'documents.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
          ]);

          // Get the logged-in user's participant ID
          $participant = Auth::user()->participant;

          if (!$participant) {
              return redirect()->back()->with('error', 'You are not registered as a participant.');
          }

          foreach ($request->file('documents') as $documentType => $file) {
              $filePath = $file->store('documents', 'public'); // Store in storage/app/public/documents

              UploadedDocument::create([
                  'participant_id' => $participant->participant_id,
                  'document_type' => $documentType,
                  'file_name' => $file->getClientOriginalName(),
                  'file_path' => $filePath,
              ]);
          }

          return redirect()->back()->with('success', 'Documents uploaded successfully.');
      }

      public function viewDocuments()
      {
          $participant = Auth::user()->participant;

          if (!$participant) {
              return redirect()->back()->with('error', 'You are not registered as a participant.');
          }

          $documents = UploadedDocument::where('participant_id', $participant->participant_id)->get();

          return view('dashboard.participant.view_documents', compact('documents'));
      }

      public function userDocuments()
    {
        $user = auth()->user();
        $participant = $user->participant;

        if (!$participant) {
            return redirect()->back()->with('error', 'No participant record found.');
        }

        $documents = $participant->uploadedDocuments; // Fetch all documents

        return view('dashboard.participant.participant', compact('documents'));
    }

    public function viewadminDocuments($participant_id = null)
    {
        // If participant_id is provided, filter documents
        if ($participant_id) {
            $documents = UploadedDocument::where('participant_id', $participant_id)->get();
        } else {
            $documents = UploadedDocument::all(); // Show all documents if no participant is selected
        }

        return view('dashboard.admin.participant.documents', compact('documents', 'participant_id'));
    }


}
