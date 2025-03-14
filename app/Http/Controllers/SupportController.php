<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use App\Models\EventParticipant;
use App\Models\UploadedDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{

    public function support()
    {
        $totalAttended = EventParticipant::whereNotNull('attendance_datetime')->count();
        $totalParticipants = Participant::count();
        $totalUsers = User::count();
        $totalSpeakers = Speaker::count();
        $totalEvents = Event::count();
        $totalCooperative = Cooperative::count();
        $latestEvent = Event::with('speakers')->orderBy('start_date', 'desc')->first();
        $latestEvents = Event::with('speakers')->orderBy('start_date', 'desc')->take(5)->get();

        $totalMigsAttended = EventParticipant::whereNotNull('attendance_datetime')
        ->whereHas('participant.cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs');
        })
        ->distinct('participant_id')
        ->count('participant_id');

        $totalMigsParticipants = Participant::whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs');
        })->count();

        $totalNonMigsParticipants = Participant::whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs');
        })->count();


        // Get cooperative IDs that are fully and partially registered
        $fullyRegisteredCoops = GARegistration::where('registration_status', 'Fully Registered')
            ->distinct()->count('coop_id');

        $partiallyRegisteredCoops = GARegistration::where('registration_status', 'Partial Registered')
            ->distinct()->count('coop_id');

        // Count participants based on their cooperative's registration status
        $fullyRegisteredParticipants = Participant::whereIn('coop_id',
            GARegistration::where('registration_status', 'Fully Registered')->pluck('coop_id')
        )->count();

        $partiallyRegisteredParticipants = Participant::whereIn('coop_id',
            GARegistration::where('registration_status', 'Partial Registered')->pluck('coop_id')
        )->count();

        return view('dashboard.support.admin', compact(
            'totalParticipants', 'totalUsers', 'totalSpeakers', 'totalEvents', 'latestEvent',
            'fullyRegisteredCoops', 'partiallyRegisteredCoops',
            'fullyRegisteredParticipants', 'partiallyRegisteredParticipants', 'totalCooperative', 'totalAttended', 'totalMigsAttended', 'totalMigsParticipants','totalNonMigsParticipants','latestEvents'
        ));
    }

    public function supportview(Request $request)
    {
        $search = $request->input('search');
        $filterNoGA = $request->input('filter_no_ga2');
        $limit = $request->input('limit', 5);

        $cooperatives = Cooperative::query();

        // Apply filter first
        if ($filterNoGA === '1') {
            $cooperatives->whereDoesntHave('gaRegistration');
        }

        // Apply search if provided
        if ($search) {
            $cooperatives->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('region', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhereHas('gaRegistration', function ($query) use ($search) {
                        $query->where('registration_status', 'LIKE', "%{$search}%")
                              ->orWhere('membership_status', 'LIKE', "%{$search}%");
                    });
            });
        }

         $cooperatives = $cooperatives->orderBy('created_at', 'desc')->paginate($limit);

        $emails = $cooperatives->pluck('email')->filter()->implode(',');

        return view('dashboard.support.datatable', compact('cooperatives', 'search', 'emails', 'filterNoGA'));
    }

    public function editProfile3()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard.support.myprofile', compact('user')); // Pass user data to the view
    }


    public function updateProfile3(Request $request)
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

        // Update the other fields
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Password will be updated only if filled
            'password' => $user->password ?? $user->password,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile.edit3')->with('success', 'Profile updated successfully!');
    }

    public function show_support($id)
    {
        // Find the cooperative by ID
        $coop = Cooperative::findOrFail($id);

        // Pass the cooperative data to the view
        return view('dashboard.support.view', compact('coop'));
    }

    public function viewsupportDocuments($coop_id = null)
    {
        // If participant_id is provided, filter documents
        if ($coop_id) {
            $documents = UploadedDocument::where('coop_id', $coop_id)->get();
        } else {
            $documents = UploadedDocument::all(); // Show all documents if no participant is selected
        }

        return view('dashboard.support.documents', compact('documents', 'coop_id'));
    }

    public function updateDocumentStatus(Request $request, $document_id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Checked,Approved,Rejected',
            'remarks' => 'nullable|string|max:255'
        ]);

        $document = UploadedDocument::findOrFail($document_id);
        $document->status = $request->status;
        $document->remarks = $request->remarks;
        $document->save();

        return back()->with('success', 'Document status and remarks updated successfully.');
    }
}
