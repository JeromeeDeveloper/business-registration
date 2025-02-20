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

        // Fetch participant using Eloquent relationship
        $participant = $user->participant;

        // Fetch latest event
        $event = Event::latest()->first();

        // Fetch GA Registration statuses based on the user's coop_id
        $gaRegistrations = GARegistration::where('coop_id', $user->coop_id)->get();

        return view('dashboard.participant_viewer.dashboard', compact('cooperative', 'participant', 'event', 'gaRegistrations'));
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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',user_id',
            'password' => 'nullable|string|min:6|confirmed', // Only validate if password is provided
        ]);


        $user = Auth::user();


        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }


        $user->update([
            'name' => $request->name,
            'email' => $request->email,

            'password' => $user->password ?? $user->password,
        ]);


        return redirect()->route('participant.profile.user.edit')->with('success', 'Profile updated successfully!');
    }


}
