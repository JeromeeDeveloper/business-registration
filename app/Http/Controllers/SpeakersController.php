<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakersController extends Controller
{
    /**
     * Store a newly created speaker in storage.
     *
     *
     */

     public function index()
    {
        $speakers = Speaker::with('event')->get(); // Load speakers with their associated event
        $events = Event::all(); // Get all events for the dropdown
        return view('components.admin.speakers.datatable', compact('speakers', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'event_id' => 'required|exists:events,event_id',
        ]);

        Speaker::create($request->all());

        return redirect()->back()->with('success', 'Speaker added successfully.');
    }

    /**
     * Show the form for editing the specified speaker.
     */
    public function edit(Speaker $speaker)
    {
        return response()->json($speaker);
    }

    /**
     * Update the specified speaker in storage.
     */
    public function update(Request $request, $speaker_id)
    {
        $speaker = Speaker::findOrFail($speaker_id);  // Manually retrieve speaker by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'event_id' => 'required|exists:events,event_id',
        ]);

        // Update the speaker data
        $speaker->update($request->only(['name', 'topic', 'event_id']));

        return redirect()->route('speakers.index')->with('success', 'Speaker updated successfully.');
    }
    /**
     * Remove the specified speaker from storage.
     */
    public function destroy(Speaker $speaker)
    {
        $speaker->delete();

        return redirect()->back()->with('success', 'Speaker deleted successfully.');
    }
}
