<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use Illuminate\Support\Facades\Auth;

class ViewerController extends Controller
{
    public function dashboardviewer()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }

    $cooperative = Cooperative::where('coop_id', $user->coop_id)->first();

    $participant = $user->participant;

    $event = Event::latest()->first();

    $gaRegistrations = GARegistration::where('coop_id', $user->coop_id)->get();

    // ✅ Fetch latest 5 events with speakers
    $latestEvents = Event::with('speakers')->orderBy('start_date', 'desc')->take(5)->get();

    return view('dashboard.participant_viewer.dashboard', compact(
        'cooperative',
        'participant',
        'event',
        'gaRegistrations',
        'latestEvents' // ✅ pass to the view
    ));
}


    public function events_participant()
    {
        $events = Event::all(); // Get all events
        return view('dashboard.participant_viewer.eventschedule', compact('events'));
    }

    public function speakerlistparticipant(Request $request)
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
            ->paginate(10); // Ensure pagination is applied

        return view('dashboard.participant_viewer.speakers', compact('speakers', 'search'));
    }

    public function editProfilepart()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard.participant_viewer.participantprofile', compact('user'));
    }

    public function updateProfileParticipant(Request $request)
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

    // Update the participant's email to the same as the user's email
    $participant = $user->participant; // Get the associated participant
    if ($participant) {
        $participant->update([
            'email' => $request->email, // Update the participant email to the new user email
        ]);
    }

    // Redirect back with a success message
    return redirect()->route('participant.profile.user.edit')->with('success', 'Profile updated successfully and participant email synced!');
}



}
