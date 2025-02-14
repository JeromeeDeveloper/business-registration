<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::all(); // Get all events
        return view('dashboard.admin.events.datatable', compact('events'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->back()->with('success', 'Event added successfully.');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);
        return response()->json($event);
    }
    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->only(['title', 'description', 'start_date', 'end_date', 'location']));

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function schedule()
    {
        $events = Event::all(); // Get all events
        return view('dashboard.participant.eventschedule', compact('events'));
    }


}
