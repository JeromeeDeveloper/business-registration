<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use Illuminate\Validation\Rule;
use App\Models\EventParticipant;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\CooperativeNotification;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\ReportsExport; // If using Excel
use App\Mail\CooperativeNotificationCredentials;

class DashboardController extends Controller
{

    public function generateReports()
    {
        // No. of MIGS Coops with Voting Delegates per Region
        $migsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                  ->where('registration_status', 'Partial Registered')
                  ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // No. of Fully Registered MIGS Coops with Voting Delegates per Region
        $fullyRegisteredMigsCoops = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                  ->where('registration_status', 'Fully Registered')
                  ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // No. of NON-MIGS Coops with Voting Delegates per Region
        $nonMigsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs')
                  ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // Total Allowable Votes per Region
        $totalAllowableVotes = Cooperative::selectRaw('region, SUM(no_of_entitled_votes) as total_votes')
            ->groupBy('region')->get();

        // Total Tagged as Voting Delegates (MIGS) per Region
        $totalVotingDelegatesMigs = GARegistration::where('membership_status', 'MIGS')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        // Total Tagged as Voting Delegates (NON-MIGS) per Region
        $totalVotingDelegatesNonMigs = GARegistration::where('membership_status', 'Non-migs')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        // Returning a view with data (or export as PDF/Excel if needed)
        return view('dashboard.admin.reports', compact(
            'migsCoopsWithVotingDelegates', 'fullyRegisteredMigsCoops', 'nonMigsCoopsWithVotingDelegates',
            'totalAllowableVotes', 'totalVotingDelegatesMigs', 'totalVotingDelegatesNonMigs'
        ));
    }


    public function sendNotification($coopId)
    {
        try {
            \Log::info('Notification request received for Coop ID: ' . $coopId);

            // Find the cooperative by ID
            $coop = Cooperative::findOrFail($coopId);
            \Log::info('Found cooperative: ' . $coop->name . ' with email: ' . $coop->email);

            // Get the latest event for the cooperative
            $event = Event::latest()->first();

            // Fetch GA Registration details
            $gaRegistration = GARegistration::where('coop_id', $coopId)->latest()->first();

            // Send the email and pass cooperative, event, and GA registration data
            Mail::to($coop->email)->send(new CooperativeNotification($coop, $event, $gaRegistration));
            \Log::info('Notification sent to: ' . $coop->email);

            return redirect()->route('adminview')->with('success', 'Notification sent to the cooperative!');
        } catch (\Exception $e) {
            \Log::error('Error sending notification: ' . $e->getMessage());
            return back()->with('error', 'Error sending notification: ' . $e->getMessage());
        }
    }


    public function sendNotificationToAll()
    {
        try {
            \Log::info('Notification request received for all cooperatives.');

            // Retrieve all cooperatives
            $cooperatives = Cooperative::all();

            if ($cooperatives->isEmpty()) {
                return back()->with('error', 'No cooperatives found.');
            }

            // Get the latest event
            $event = Event::latest()->first();

            if (!$event) {
                return back()->with('error', 'No event found to notify.');
            }

            // Send email to each cooperative
            foreach ($cooperatives as $coop) {
                // Retrieve GA Registration for the current cooperative
                $gaRegistration = GARegistration::where('coop_id', $coop->coop_id)->latest()->first();

                // Send email
                Mail::to($coop->email)->send(new CooperativeNotification($coop, $event, $gaRegistration));

                \Log::info('Notification sent to: ' . $coop->email);
            }

            return redirect()->route('adminview')->with('success', 'Notification sent to all cooperatives!');
        } catch (\Exception $e) {
            \Log::error('Error sending notifications: ' . $e->getMessage());

            return back()->with('error', 'Error sending notifications. Please try again.');
        }
    }


    public function sendCredentialsToAll()
    {
        try {
            \Log::info('Notification request received for all cooperatives.');

            // Retrieve all cooperatives
            $cooperatives = Cooperative::all();

            if ($cooperatives->isEmpty()) {
                return back()->with('error', 'No cooperatives found.');
            }

            // Get the latest event
            $event = Event::latest()->first();

            if (!$event) {
                return back()->with('error', 'No event found to notify.');
            }

            // Send email to each cooperative with its specific users (only those with role "cooperative")
            foreach ($cooperatives as $coop) {
                if (!$coop->email) { // Ensure cooperative has an email
                    \Log::warning("Skipped cooperative {$coop->name} due to missing email.");
                    continue;
                }

                // Fetch only users with role "cooperative" belonging to the current cooperative
                $users = User::where('coop_id', $coop->coop_id)
                             ->where('role', 'cooperative')
                             ->get();

                if ($users->isNotEmpty()) {
                    Mail::to($coop->email)->send(new CooperativeNotificationCredentials($coop, $event, $users));
                    \Log::info("Notification sent to: {$coop->email}");
                } else {
                    \Log::info("Skipped cooperative: {$coop->name} (No cooperative users found)");
                }
            }

            return redirect()->route('adminview')->with('success', 'Notification sent to all cooperatives!');
        } catch (\Exception $e) {
            \Log::error('Error sending notifications: ' . $e->getMessage());
            return back()->with('error', 'Error sending notifications: ' . $e->getMessage());
        }
    }


    public function admin()
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

        return view('dashboard.admin.admin', compact(
            'totalParticipants', 'totalUsers', 'totalSpeakers', 'totalEvents', 'latestEvent',
            'fullyRegisteredCoops', 'partiallyRegisteredCoops',
            'fullyRegisteredParticipants', 'partiallyRegisteredParticipants', 'totalCooperative', 'totalAttended', 'totalMigsAttended', 'totalMigsParticipants','totalNonMigsParticipants','latestEvents'
        ));
    }

    public function participant()
    {
        $user = Auth::user();

        // Ensure the user is logged in and has a coop_id
        if (!$user || !$user->coop_id) {
            dd('User not found or coop_id not set');
        }

        // Fetch the participant details, including the cooperative and registration details
        $participant = $user->participant()->with('cooperative', 'registration')->first();

        // Fetch the latest event (most recent based on start_date)
        $latestEvent = Event::with('speakers')->orderBy('start_date', 'desc')->first();

        // Count total events
        $totalEvents = Event::count();

        $latestEvents = Event::with('speakers')->orderBy('start_date', 'desc')->take(5)->get();

        // Count total speakers
        $totalSpeakers = Speaker::count();

        // Count total participants
        $totalParticipants = Participant::where('coop_id', $user->coop_id)->count();


        // Fetch the cooperative from the participant relationship (ensure coop_id exists)
        $cooperative = $participant ? $participant->cooperative : null;

        $totalDocuments = UploadedDocument::where('coop_id', $user->coop_id)
        ->where('status', 'Approved')
        ->count();


        // Fetch GARegistration record based on the user's coop_id
        $gaRegistration = $user && $user->coop_id
            ? GARegistration::where('coop_id', $user->coop_id)->first()
            : null;

        // Ensure default values for registration_status and membership_status
        $registrationStatus = $gaRegistration ? $gaRegistration->registration_status : 'N/A';
        $membershipStatus = $gaRegistration ? $gaRegistration->membership_status : 'Non-migs';

        // Fetch Cooperative based on logged-in user's coop_id
        $coop = $user && $user->coop_id ? Cooperative::where('coop_id', $user->coop_id)->first() : null;

        return view('dashboard.participant.participant', [
            'participant' => $participant,
            'event' => $latestEvent,
            'totalEvents' => $totalEvents,
            'totalSpeakers' => $totalSpeakers,
            'totalParticipants' => $totalParticipants, // Pass total participants
            'totalDocuments' => $totalDocuments, // Pass total uploaded documents
            'registrationStatus' => $registrationStatus,
            'membershipStatus' => $membershipStatus,
            'cooperative' => $cooperative,
            'coop' => $coop,
            'latestEvents' => $latestEvents, // ✅ FIXED: added to pass the events
        ]);
    }




    public function cooperativeprofile($coop_id)
    {
        $cooperative = Cooperative::findOrFail($coop_id);

        return view('dashboard.participant.cooperativeprofile', compact('cooperative'));
    }

    public function editCooperativeProfile($coop_id)
    {
        // Fetch the cooperative details using the ID
        $cooperative = Cooperative::findOrFail($coop_id);

        // Return the edit view with cooperative data
        return view('dashboard.participant.edit', compact('cooperative'));
    }

    public function updateCooperativeProfile(Request $request, $coop_id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'general_manager_ceo' => 'required|string|max:255',
            'region' => [
            'required',
            Rule::in([
                'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
                'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
                'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'
            ]),
        ],
            'phone_number' => 'required|string|max:20',
            'tin' => 'required|string|max:50',
            'total_asset' => 'nullable|numeric|min:0',
            'total_income' => 'nullable|numeric|min:0',
            'cetf_remittance' => 'nullable|numeric|min:0',
            'cetf_required' => 'nullable|numeric|min:0',
            'cetf_balance' => 'nullable|numeric|min:0',
            'share_capital_balance' => 'nullable|numeric|min:0',
            'no_of_entitled_votes' => 'nullable|integer|min:0',
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email'),
                Rule::unique('cooperatives', 'email')->ignore($coop_id, 'coop_id'), // Ignore itself
            ],
            'address' => 'required|string|max:255',
            'services_availed' => 'nullable|array', // Ensure it's an array (from checkboxes)
            'services_availed.*' => 'string|max:255', // Ensure each item is a string
        ]);

        $validated['total_asset'] = $request->total_asset ? (float) str_replace(',', '', $request->total_asset) : null;
        $validated['total_income'] = $request->total_income ? (float) str_replace(',', '', $request->total_income) : null;
        $validated['cetf_remittance'] = $request->cetf_remittance ? (float) str_replace(',', '', $request->cetf_remittance) : null;
        $validated['cetf_required'] = $request->cetf_required ? (float) str_replace(',', '', $request->cetf_required) : null;
        $validated['cetf_balance'] = $request->cetf_balance ? (float) str_replace(',', '', $request->cetf_balance) : null;
        $validated['share_capital_balance'] = $request->share_capital_balance ? (float) str_replace(',', '', $request->share_capital_balance) : null;
        $validated['no_of_entitled_votes'] = $request->no_of_entitled_votes ? (int) $request->no_of_entitled_votes : null;

        // Store services_availed as a JSON string
        $validated['services_availed'] = isset($request->services_availed)
            ? json_encode($request->services_availed) // Convert array to JSON
            : json_encode([]); // Store empty JSON array if no services selected

        // Find the cooperative by its ID and update the details
        $cooperative = Cooperative::findOrFail($coop_id);
        $cooperative->update($validated);

        // // Validate the request
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'contact_person' => 'nullable|string|max:255',
        //     'type' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'region' => 'required|string|max:255',
        //     'phone_number' => 'nullable|string|max:20',
        //     'email' => 'nullable|email|max:255',
        //     'tin' => 'nullable|string|max:255',
        //     'coop_identification_no' => 'nullable|string|max:255',
        //     'bod_chairperson' => 'nullable|string|max:255',
        //     'general_manager_ceo' => 'nullable|string|max:255',
        //     'total_asset' => 'nullable|numeric',
        //     'total_income' => 'nullable|numeric',
        //     'cetf_remittance' => 'nullable|numeric',
        //     'cetf_required' => 'nullable|numeric',
        //     'cetf_balance' => 'nullable|numeric',
        //     'share_capital_balance' => 'required|numeric',
        //     'no_of_entitled_votes' => 'nullable|integer',
        //     'services_availed' => 'nullable|string|max:255',
        // ]);

        // // Find the cooperative by ID
        // $cooperative = Cooperative::findOrFail($coop_id);

        // // Update the cooperative record
        // $cooperative->update($request->all());

        // Redirect back with a success message
        return redirect()->route('cooperativeprofile', ['coop_id' => $coop_id])
                         ->with('success', 'Cooperative profile updated successfully!');
    }


    public function participantregister()
{
    $cooperatives = Cooperative::all();
    return view('dashboard.participant.register', compact('cooperatives'));
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
    $participant = Participant::create($validatedData);

    // Generate QR code data (e.g., a URL to their profile page)
    $qrData = route('scanQR', ['participant_id' => $participant->participant_id]); // Use scanQR API


    // Call the external QR code API
    $response = Http::get('https://api.qrserver.com/v1/create-qr-code/', [
        'data' => $qrData,
        'size' => '200x200' // You can adjust the size here
    ]);

    // Check if the QR code generation is successful
    if ($response->successful()) {
        // Save the QR code image
        $path = 'qrcodes/participant_' . $participant->participant_id . '.png';
        Storage::disk('public')->put($path, $response->body());

        // Optionally, save the QR code path to the participant
        $participant->qr_code = $path;
        $participant->save();
    } else {
        // Handle failure if the QR code generation fails
        return redirect()->route('participant.register')->with('error', 'Failed to generate QR code.');
    }

    // Redirect or return a response
    return redirect()->route('participant.register')->with('success', 'Participant registered successfully!');
}

public function scanQR(Request $request)
{
    $participantId = $request->query('participant_id');
    $eventId = $request->query('event_id');

    $participant = Participant::find($participantId);
    if (!$participant) {
        return response()->json(['error' => 'Participant not found.'], 404);
    }

    $event = Event::find($eventId);
    if (!$event) {
        return response()->json(['error' => 'Event not found.'], 404);
    }

    $gaRegistration = GARegistration::where('coop_id', $participant->coop_id)->first();

    if (!$gaRegistration || $gaRegistration->registration_status === 'Partial Registered' || $gaRegistration->registration_status === null) {
        return response()->json(['error' => 'Participant cannot be scanned. GA registration is incomplete.'], 403);
    }

    // Check if participant is registered in this congress (event)
    $isRegisteredInEvent = $participant->events()
        ->where('event_participant.event_id', $eventId) // Explicitly use event_participant.event_id
        ->exists();

    if (!$isRegisteredInEvent) {
        return response()->json(['error' => 'Participant is not added in this congress.'], 403);
    }

    // Check if attendance is already recorded
    $existingAttendance = EventParticipant::where('event_id', $eventId)
        ->where('participant_id', $participantId)
        ->whereNotNull('attendance_datetime')
        ->first();

    if ($existingAttendance) {
        return response()->json(['error' => 'Attendance already recorded for this participant.'], 409);
    }

    // Record attendance
    $attendance = EventParticipant::updateOrCreate(
        [
            'event_id' => $eventId,
            'participant_id' => $participantId,
        ],
        [
            'attendance_datetime' => now(),
        ]
    );

    return response()->json(['success' => 'Attendance recorded successfully!', 'participant' => $participant]);
}


    // Show the cooperative registration form
    public function register()
    {
        return view('dashboard.admin.register');
    }

    public function view(Request $request)
    {
        $search = $request->input('search');
        $filterNoGA = $request->input('filter_no_ga');

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

        $cooperatives = $cooperatives->orderBy('created_at', 'desc')->paginate(5);

        $emails = $cooperatives->pluck('email')->filter()->implode(',');

        return view('dashboard.admin.datatable', compact('cooperatives', 'search', 'emails', 'filterNoGA'));
    }




public function storeCooperative(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'phone_number' => 'required|numeric',
        'email' => 'required|email|unique:users,email',
        'tin' => 'required|string|max:255',
        'coop_identification_no' => 'required|string|max:255',
        'bod_chairperson' => 'required|string|max:255',
        'general_manager_ceo' => 'required|string|max:255',
        'total_asset' => 'required|numeric',
        'total_income' => 'required|numeric',
        'cetf_remittance' => 'required|numeric',
        'cetf_required' => 'required|numeric',
        'cetf_balance' => 'required|numeric',
        'share_capital_balance' => 'required|numeric',
        'no_of_entitled_votes' => 'required|numeric',
        'services_availed' => 'required|array', // Expect an array
        'services_availed.*' => 'string|in:CF,IT,MSU,ICS,MCU,ADMIN,GAD,YOUTH,SCOOPS,YAKAP,AGRIBEST',
    ]);

    // Store the selected services as JSON
    $servicesAvailed = json_encode($request->services_availed);

    // Create the cooperative entry
    $cooperative = Cooperative::create([
        'name' => $request->name,
        'contact_person' => $request->contact_person,
        'type' => $request->type,
        'address' => $request->address,
        'region' => $request->region,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'tin' => $request->tin,
        'coop_identification_no' => $request->coop_identification_no,
        'bod_chairperson' => $request->bod_chairperson,
        'general_manager_ceo' => $request->general_manager_ceo,
        'total_asset' => $request->total_asset,
        'total_income' => $request->total_income,
        'cetf_remittance' => $request->cetf_remittance,
        'cetf_required' => $request->cetf_required,
        'cetf_balance' => $request->cetf_balance,
        'share_capital_balance' => $request->share_capital_balance,
        'no_of_entitled_votes' => $request->no_of_entitled_votes,
        'services_availed' => $servicesAvailed, // Save as JSON
    ]);

    // Generate a sanitized password
    $words = preg_split('/\s+/', trim($cooperative->name));
    $acronym = '';
    foreach ($words as $word) {
        $acronym .= strtoupper($word[0]);
    }

    $sanitizedPassword = $acronym . 'GA2025';

    // Create the user account
    User::create([
        'name' => $cooperative->contact_person,
        'coop_id' => $cooperative->coop_id,
        'email' => $cooperative->email,
        'password' => Hash::make($sanitizedPassword),
        'role' => 'cooperative',
    ]);

    return response()->json([
        'success' => 'Cooperative and User registered successfully!',
        'generated_password' => $sanitizedPassword,
    ]);
}



    public function destroy($coop_id)
    {
        // Find the cooperative by ID and delete it
        $coop = Cooperative::findOrFail($coop_id);
        $coop->delete();

        // Redirect back to the cooperatives page with a success message
        return redirect()->route('adminview')->with('success', 'Cooperative deleted successfully!');
    }
    public function edit($coop_id)
    {
        $coop = Cooperative::findOrFail($coop_id); // Find the cooperative by its ID
        return view('dashboard.admin.edit', compact('coop')); // Pass cooperative data to the edit view
    }

    public function update(Request $request, $coop_id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'general_manager_ceo' => 'required|string|max:255',
            'region' => [
                'required',
                Rule::in([
                    'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
                    'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
                    'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'
                ]),
            ],
            'phone_number' => 'required|string|max:20',
            'tin' => 'required|string|max:50',
            'total_asset' => 'nullable|numeric|min:0',
            'total_income' => 'nullable|numeric|min:0',
            'cetf_remittance' => 'nullable|numeric|min:0',
            'cetf_required' => 'nullable|numeric|min:0',
            'cetf_balance' => 'nullable|numeric|min:0',
            'share_capital_balance' => 'nullable|numeric|min:0',
            'no_of_entitled_votes' => 'nullable|integer|min:0',
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email'),
                Rule::unique('cooperatives', 'email')->ignore($coop_id, 'coop_id'),
            ],
            'address' => 'required|string|max:255',
            'services_availed' => 'nullable|array',
            'services_availed.*' => 'string|max:255',
        ]);

        $validated['total_asset'] = $request->total_asset ? (float) str_replace(',', '', $request->total_asset) : null;
        $validated['total_income'] = $request->total_income ? (float) str_replace(',', '', $request->total_income) : null;
        $validated['cetf_remittance'] = $request->cetf_remittance ? (float) str_replace(',', '', $request->cetf_remittance) : null;
        $validated['cetf_required'] = $request->cetf_required ? (float) str_replace(',', '', $request->cetf_required) : null;
        $validated['cetf_balance'] = $request->cetf_balance ? (float) str_replace(',', '', $request->cetf_balance) : null;
        $validated['share_capital_balance'] = $request->share_capital_balance ? (float) str_replace(',', '', $request->share_capital_balance) : null;
        $validated['no_of_entitled_votes'] = $request->no_of_entitled_votes ? (int) $request->no_of_entitled_votes : null;

        $validated['services_availed'] = isset($request->services_availed)
            ? json_encode($request->services_availed)
            : json_encode([]);

        // Find the cooperative by its ID and update the details
        $coop = Cooperative::findOrFail($coop_id);
        $coop->update($validated);

        // Find the user linked to this cooperative
        $user = User::where('coop_id', $coop->coop_id)->first();

        if ($user) {
            $currentUserEmail = strtolower(trim($user->email));
            $newCoopEmail = strtolower(trim($coop->email));

            if ($currentUserEmail !== $newCoopEmail) {
                $emailExists = User::where('email', $coop->email)
                    ->where('user_id', '!=', $user->user_id)
                    ->exists();

                if ($emailExists) {
                    return redirect()->back()->withErrors(['email' => 'The email is already used by another user.']);
                }

                $user->update([
                    'name' => $coop->contact_person,
                    'email' => $coop->email,
                ]);
            } else {
                // Just update the name if email didn't change
                $user->update([
                    'name' => $coop->contact_person,
                ]);
            }
        }


        return redirect()->route('adminview')->with('success', 'Cooperative updated successfully!');
    }




    public function show($id)
    {
        // Find the cooperative by ID
        $coop = Cooperative::findOrFail($id);

        // Pass the cooperative data to the view
        return view('dashboard.admin.view', compact('coop'));
    }

    public function userregister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                Rule::unique('participants', 'email'),
            ],
            'password' => 'required|min:6',
            'coop_id' => 'required|exists:cooperatives,coop_id',
            'role' => ['required', Rule::in(['participant', 'admin', 'cooperative'])], // Validate role
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already taken in either Users or Participants.',
            'password.required' => 'The password field is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'coop_id.required' => 'Please select a cooperative.',
            'coop_id.exists' => 'Selected cooperative is invalid.',
            'role.required' => 'Please select a role.',
            'role.in' => 'Invalid role selected.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Assign role dynamically
            'coop_id' => $request->coop_id, // Store selected cooperative
        ]);

        return redirect()->route('registerform')->with('success', 'Registration successful!');
    }



    public function registerform()
    {
        $participant = Participant::all(); // Or any other data fetching logic
        $cooperatives = Cooperative::all();
        // Pass $participant to the view
        return view('dashboard.admin.user.register', compact('participant', 'cooperatives'));
    }

    public function showQR($id)
    {
        $participant = Participant::findOrFail($id);

        return view('dashboard.admin.admin', compact('participant'));
    }





    }

