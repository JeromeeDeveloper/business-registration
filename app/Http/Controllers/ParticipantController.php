<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

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

    // Show a specific participant
    public function show($participant_id)
    {
        // Use 'participant_id' for the identifier
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('participants.show', compact('participant'));
    }

    // Show the form for editing a participant
    public function edit($participant_id)
    {
        // Use 'participant_id' for the identifier
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('participants.edit', compact('participant'));
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
}
