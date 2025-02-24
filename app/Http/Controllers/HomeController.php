<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Cooperative;
use App\Models\Speaker;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch counts from the database
        $participantsCount = Participant::count();
        $cooperativesCount = Cooperative::count();
        $speakersCount = Speaker::count();

        // Fetch latest events
        $events = Event::with('speakers')->latest()->take(3)->get();

        // Pass data to the view
        return view('home.index', compact('participantsCount', 'cooperativesCount', 'speakersCount', 'events'));
    }

    public function home_participants()
    {
        // Fetch all participants with their cooperatives
        $participants = Participant::with('cooperative')->get();

        return view('home.participant', compact('participants'));
    }
}
