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
use App\Mail\CooperativeNotificationsingle;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\ReportsExport; // If using Excel
use App\Mail\CooperativeNotificationCredentials;
use App\Mail\CooperativeNotificationunregistered;

class DashboardController extends Controller
{

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

            // Fetch only users with role "cooperative" belonging to the current cooperative
            $users = User::where('coop_id', $coop->coop_id)
                ->where('role', 'cooperative')
                ->get();

            if ($users->isNotEmpty()) {
                foreach ($users as $user) {
                    // Extract the first letter of each word in the cooperative name
                    $acronym = strtoupper(implode('', array_map(fn($word) => $word[0], explode(' ', trim($coop->name)))));

                    // Generate the password using the acronym + GA2025
                    $sanitizedPassword = $acronym . 'GA2025';

                    // Update user password
                    $user->password = Hash::make($sanitizedPassword);
                    $user->save();

                    // Send email with the new password
                    Mail::to($user->email)->queue(new CooperativeNotificationsingle($coop, $event, $gaRegistration, $sanitizedPassword));

                    \Log::info("New password set for user: {$user->email} -> {$sanitizedPassword}");
                }


                return redirect()->route('adminview')->with('success', 'Notification sent with updated password!');
            } else {
                \Log::info("Skipped cooperative: {$coop->name} (No cooperative users found)");
            }

            return redirect()->route('adminview')->with('success', 'Notification sent to the cooperative!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Cooperative not found: ' . $e->getMessage());
            return back()->with('error', 'Cooperative not found.');
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
            $event = Event::oldest()->first();

            if (!$event) {
                return back()->with('error', 'No event found to notify.');
            }

            // Send email to each cooperative
            foreach ($cooperatives as $coop) {
                // Retrieve GA Registration for the current cooperative
                $gaRegistration = GARegistration::where('coop_id', $coop->coop_id)->latest()->first();

                // Retrieve users related to the cooperative (Adjust as needed)
                $users = User::where('coop_id', $coop->coop_id)->get(); // Assuming User has a `coop_id`

                // Send email with the correct number of arguments
                Mail::to($coop->email)->queue(new CooperativeNotification($coop, $event, $gaRegistration, $users));

                \Log::info('Notification sent to: ' . $coop->email);
            }

            return redirect()->route('adminview')->with('success', 'Notification sent to all cooperatives!');
        } catch (\Exception $e) {
            \Log::error('Error sending notifications: ' . $e->getMessage());

            return back()->with('error', 'Error sending notifications. Please try again.');
        }
    }

    public function sendNotificationToAllunregistered()
{
    try {
        \Log::info('Notification request received for all cooperatives.');

        // Retrieve all cooperatives
        $cooperatives = Cooperative::all();

        if ($cooperatives->isEmpty()) {
            return back()->with('error', 'No cooperatives found.');
        }

        // Get the latest event
        $event = Event::oldest()->first();

        if (!$event) {
            return back()->with('error', 'No event found to notify.');
        }

        // Send email to cooperatives with GARegistration status 'Rejected'
        foreach ($cooperatives as $coop) {
            // Retrieve GA Registration for the current cooperative with 'Rejected' status
            $gaRegistration = GARegistration::where('coop_id', $coop->coop_id)
                                              ->where('registration_status', 'Rejected') // Only 'Rejected' status
                                              ->latest()
                                              ->first();

            // Check if GA Registration exists and status is 'Rejected'
            if ($gaRegistration) {
                // Retrieve users related to the cooperative (Adjust as needed)
                $users = User::where('coop_id', $coop->coop_id)->get(); // Assuming User has a `coop_id`

                // Send email with the correct number of arguments
                Mail::to($coop->email)->queue(new CooperativeNotificationunregistered($coop, $event, $gaRegistration, $users));

                \Log::info('Notification sent to: ' . $coop->email);
            }
        }

        return redirect()->route('adminview')->with('success', 'Notification sent to all cooperatives with rejected registrations!');
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
            $event = Event::oldest()->first();

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

        $regions = Cooperative::distinct()->pluck('region', 'region')->sort();

        $totalAttended = EventParticipant::whereNotNull('attendance_datetime')->count();
        $totalParticipants = Participant::count();
        $totalUsers = User::count();
        $totalSpeakers = Speaker::count();
        $totalEvents = Event::count();
        $totalCooperative = Cooperative::count();
        $latestEvent = Event::with('speakers')->orderBy('start_date', 'desc')->first();
        $latestEvents = Event::with('speakers')->orderBy('start_date', 'desc')->take(5)->get();

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
        $fullyRegisteredParticipants = Participant::whereIn(
            'coop_id',
            GARegistration::where('registration_status', 'Fully Registered')->pluck('coop_id')
        )->count();

        $partiallyRegisteredParticipants = Participant::whereIn(
            'coop_id',
            GARegistration::where('registration_status', 'Partial Registered')->pluck('coop_id')
        )->count();

        // Registered Coops: Fully or Partially Registered with GARegistration
        $registeredCoops = GARegistration::whereIn('registration_status', ['Fully Registered', 'Partial Registered'])
            ->whereNotNull('coop_id')
            ->distinct()
            ->count('coop_id');

        // Count registered MIGS Coops
        // Count registered MIGS Coops with Participant connection
        $registeredMigsCoops = GARegistration::where('membership_status', 'Migs')
            ->whereHas('cooperative.participants')
            ->distinct()->count('coop_id');

        // Count registered NON-MIGS Coops with Participant connection
        $registeredNonMigsCoops = GARegistration::where('membership_status', 'Non-migs')
            ->whereHas('cooperative.participants')
            ->distinct()->count('coop_id');

        $totalCoopAttended = DB::table('participants')
            ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->whereNotNull('event_participant.attendance_datetime') // Ensures the participant attended
            ->distinct('participants.coop_id') // Counts each coop only once
            ->count('participants.coop_id');

        $totalMigsAttended = DB::table('participants')
            ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->whereNotNull('event_participant.attendance_datetime')
            ->whereIn('participants.coop_id', function ($query) {
                $query->select('coop_id')
                    ->from('ga_registrations')
                    ->where('membership_status', 'Migs');
            })
            ->distinct('participants.coop_id')
            ->count('participants.coop_id');

        $totalNonMigsAttended = DB::table('participants')
            ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->whereNotNull('event_participant.attendance_datetime')
            ->whereIn('participants.coop_id', function ($query) {
                $query->select('coop_id')
                    ->from('ga_registrations')
                    ->where('membership_status', 'Non-migs');
            })
            ->distinct('participants.coop_id')
            ->count('participants.coop_id');

            $totalVoting = Participant::where('delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            })
            ->count();

        $totalVotingParticipants = EventParticipant::whereNotNull('attendance_datetime')
            ->whereHas('participant', function ($query) {
                $query->where('delegate_type', 'Voting');
            })
            ->distinct('participant_id')
            ->count('participant_id');

        $events = Event::withCount(['participants' => function ($query) {
            $query->whereNotNull('event_participant.attendance_datetime');
        }])->get();


        $registeredParticipants = Participant::whereNotNull('coop_id')->count();

        return view('dashboard.admin.admin', compact(
            'regions',
            'totalParticipants',
            'totalUsers',
            'totalSpeakers',
            'totalEvents',
            'latestEvent',
            'fullyRegisteredCoops',
            'partiallyRegisteredCoops',
            'fullyRegisteredParticipants',
            'partiallyRegisteredParticipants',
            'totalCooperative',
            'totalAttended',
            'totalMigsAttended',
            'totalMigsParticipants',
            'totalNonMigsParticipants',
            'latestEvents',
            'registeredCoops',
            'registeredMigsCoops',
            'registeredNonMigsCoops',
            'totalCoopAttended',
            'totalCoopAttended',
            'totalVoting',
            'totalNonMigsAttended',
            'totalVotingParticipants',
            'events',
            'registeredParticipants'
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

        // Count total participants for the cooperative
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

        // ✅ Calculate votes based on share capital
        $shareCapital = $coop ? $coop->share_capital_balance : 0;
        $votes = 0;
        $remaining = $shareCapital;

        if ($remaining >= 25000) {
            if ($remaining >= 100000) {
                $votes = floor($remaining / 100000);
                $remaining %= 100000;

                // Add 1 extra vote if at least ₱25k left
                if ($remaining >= 25000) {
                    $votes += 1;
                }
            } else {
                // ₱25k up to ₱99,999 gives 1 vote
                $votes = 1;
            }
        }

        // Cap votes at 5 max
        $votes = min($votes, 5);


        // ✅ Count current Voting participants
        $currentVotingCount = Participant::where('coop_id', $user->coop_id)
            ->where('delegate_type', 'Voting')
            ->count();

        $requiredDocuments = [
            'Financial Statement',
            'Resolution for Voting delegates',
            'Deposit Slip for Registration Fee',
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization invoice'
        ];

        // Get uploaded documents
        $uploadedDocuments = UploadedDocument::where('coop_id', $user->coop_id)
            ->pluck('document_type')
            ->toArray();

        // Find missing documents
        $missingDocuments = array_diff($requiredDocuments, $uploadedDocuments);

        $declinedDocuments = UploadedDocument::where('coop_id', $user->coop_id)
            ->where('status', 'Rejected')
            ->pluck('document_type')
            ->toArray();

        return view('dashboard.participant.participant', [
            'participant' => $participant,
            'event' => $latestEvent,
            'totalEvents' => $totalEvents,
            'totalSpeakers' => $totalSpeakers,
            'totalParticipants' => $totalParticipants,
            'totalDocuments' => $totalDocuments,
            'registrationStatus' => $registrationStatus,
            'membershipStatus' => $membershipStatus,
            'cooperative' => $cooperative,
            'coop' => $coop,
            'latestEvents' => $latestEvents,
            'votes' => $votes,
            'currentVotingCount' => $currentVotingCount,
            'missingDocuments' => $missingDocuments,
            'declinedDocuments' => $declinedDocuments,
        ]);
    }




    public function cooperativeprofile($coop_id)
    {
        $cooperative = Cooperative::findOrFail($coop_id);

        // Check if cooperative has MIGS membership
        $hasMigsRegistration = GARegistration::where('coop_id', $cooperative->coop_id)
            ->where('membership_status', 'MIGS')
            ->exists();

        $hasMspOfficer = Participant::where('coop_id', $cooperative->coop_id)
            ->where('is_msp_officer', true)
            ->exists();

        // Check the total remittance
        $totalRemittance = $cooperative->total_remittance ?? 0;
        $free100kCETF = $totalRemittance >= 100000; // Free 1 pax if remittance >= 100K
        $halfBasedCETF = $totalRemittance >= 50000; // Free 1 pax if remittance >= 50K

        // Get the number of participants
        $numParticipants = $cooperative->participants()->count();

        // Calculate the number of free participants
        $freeParticipants = 0;
        if ($hasMigsRegistration) {
            $freeParticipants += 2; // Free 2 participants for MIGS
        }
        if ($hasMspOfficer) {
            $freeParticipants += 1;
        }
        if ($free100kCETF) {
            $freeParticipants += 1;
        }
        if ($halfBasedCETF) {
            $numParticipants = max(0, $numParticipants - 1); // Discount 1 participant by 50%
        }

        $paidParticipants = max($numParticipants - $freeParticipants, 0);

        // Calculate total registration fee
        $registrationFee = $cooperative->registration_fee ?? 0;
        $totalRegFee = $paidParticipants * $registrationFee;

        // Calculate registration fee payable
        $netRequiredRegFee = $cooperative->net_required_reg_fee ?? 0;
        $lessPreregPayment = $cooperative->less_prereg_payment ?? 0;
        $lessCetfBalance = $cooperative->less_cetf_balance ?? 0;

        $regFeePayable = max(0, $netRequiredRegFee - ($lessPreregPayment + $lessCetfBalance));

        return view('dashboard.participant.cooperativeprofile', compact(
            'cooperative',
            'totalRegFee',
            'regFeePayable',
            'hasMigsRegistration',
            'hasMspOfficer',
            'free100kCETF',
            'halfBasedCETF'
        ));
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
            'phone_number' => 'required|string|max:20',
            'bod_chairperson' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'tin' => 'required|string|max:50',
            'general_manager_ceo' => 'nullable|string|max:255',
        ]);

        // Find the cooperative by its ID
        $cooperative = Cooperative::findOrFail($coop_id);

        // Update only the selected fields
        $cooperative->update($validated);

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
        // $response = Http::get('https://api.qrserver.com/v1/create-qr-code/', [
        //     'data' => $qrData,
        //     'size' => '200x200' // You can adjust the size here
        // ]);

        $response = Http::timeout(30)->get('https://api.qrserver.com/v1/create-qr-code/', [
            'data' => $qrData,
            'size' => '200x200'
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
        $limit = $request->input('limit', 5); // Default to 5 if no 'limit' is provided

        $emailsall = Cooperative::pluck('email')->toArray();
        $cooperatives = Cooperative::query();

        // Apply filter for No GA Registration
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
                        if (strtoupper($search) === 'NO REGISTRATION') {
                            $query->whereNull('registration_status')
                                ->orWhere('registration_status', 'Rejected');
                        } else {
                            $query->where('registration_status', 'LIKE', "%{$search}%")
                                ->orWhere('membership_status', 'LIKE', "%{$search}%");
                        }
                    });
            });
        }

        // Apply pagination with the dynamic limit
        $cooperatives = $cooperatives->withCount(['participants',
        'participants as registered_voting_participants' => function ($query) {
            $query->where('delegate_type', 'Voting');
        }])
->orderBy('created_at', 'desc')
->paginate($limit)
->appends($request->query());

foreach ($cooperatives as $coop) {
    $shareCapital = $coop->share_capital_balance;
    $votes = 0;

    if (is_numeric($shareCapital) && $shareCapital >= 25000) {
        if ($shareCapital >= 100000) {
            $votes = floor($shareCapital / 100000); // Each 100k = 1 vote
            $remaining = $shareCapital % 100000;

            // Add 1 vote if at least 25k remaining
            if ($remaining >= 25000) {
                $votes += 1;
            }
        } else {
            // 25k to 99,999 = 1 vote
            $votes = 1;
        }

        // Cap votes at 5
        $votes = min($votes, 5);
    }

    $coop->votes = $votes; // Store in object
}


    $emails = $cooperatives->pluck('email')->filter()->implode(',');

    return view('dashboard.admin.datatable', compact('cooperatives', 'search', 'emails', 'emailsall', 'filterNoGA'));
    }



    public function storeCooperative(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:255|in:Region I,Region II,Region III,Region IV-A,Region IV-B,Region V,Region VI,Region VII,Region VIII,Region IX,Region X,Region XI,Region XII,Region XIII,NCR,CAR,BARMM,ZBST,LUZON',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:cooperatives,email',
            'tin' => 'required|string|max:255',
            'coop_identification_no' => 'nullable|string|max:255',
            'bod_chairperson' => 'nullable|string|max:255',
            'general_manager_ceo' => 'nullable|string|max:255',
            'total_asset' => 'nullable|numeric',
            'loan_balance' => 'nullable|numeric',
            'total_overdue' => 'nullable|numeric',
            'time_deposit' => 'nullable|numeric',
            'accounts_receivable' => 'nullable|numeric',
            'savings' => 'nullable|numeric',
            'net_surplus' => 'nullable|numeric',
            'no_of_entitled_votes' => 'nullable|numeric',
            'cetf_due_to_apex' => 'nullable|numeric',
            'additional_cetf' => 'nullable|numeric',
            'cetf_undertaking' => 'nullable|numeric',
            'full_cetf_remitted' => 'nullable|in:yes,no',
            'registration_date_paid' => 'nullable|date',
            'registration_fee' => 'nullable|numeric',
            'total_income' => 'nullable|numeric',
            'total_remittance' => 'nullable|numeric',
            'ga_remark' => 'nullable|string|max:255',
            'reg_fee_payable' => 'nullable|numeric',
            'less_prereg_payment' => 'nullable|numeric',
            'less_cetf_balance' => 'nullable|numeric',
            'net_required_reg_fee' => 'nullable|numeric',
            'fs_status' => 'nullable|in:yes,no',
            'delinquent' => 'nullable|in:yes,no',
            'cetf_remittance' => 'nullable|numeric',
            'cetf_required' => 'nullable|numeric',
            'cetf_balance' => 'nullable|numeric',
            'total_reg_fee' => 'nullable|numeric',
            'share_capital_balance' => 'nullable|numeric',
            'services_availed' => 'nullable|array',
            'services_availed.*' => 'string|in:CF,IT,MSU,ICS,MCU,ADMIN,GAD,YOUTH,SCOOPS,YAKAP,AGRIBEST',
            'other_services' => 'nullable|string|max:255',
            'total_members' => 'nullable|integer',
            'regular_members' => 'nullable|integer',
            'associate_members' => 'nullable|integer',
            'date_registered' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'affiliated_orgs' => 'nullable|string|max:255'
        ]);



        // Calculate entitled votes based on share capital balance
        $shareCapital = $request->share_capital_balance;
        $votes = 0;
        $remaining = $shareCapital;

        if (is_numeric($shareCapital) && $shareCapital > 0) {
            // Calculate based on ₱100,000 blocks
            if ($remaining >= 100000) {
                $votes += floor($remaining / 100000); // Every ₱100,000 gives 1 vote
            }

            $remaining = $remaining % 100000; // Remaining after full ₱100,000 blocks

            // Handle ₱75,000, ₱50,000, and ₱25,000 blocks for additional votes
            while ($remaining >= 25000) {
                if ($remaining >= 75000) {
                    $votes += 3; // ₱75,000 → +3 votes
                    $remaining -= 75000;
                } elseif ($remaining >= 50000) {
                    $votes += 2; // ₱50,000 → +2 votes
                    $remaining -= 50000;
                } elseif ($remaining >= 25000) {
                    $votes += 1; // ₱25,000 → +1 vote
                    $remaining -= 25000;
                }
            }

            // Max votes = 5
            $votes = min($votes, 5);
        }

        // Store the selected services as JSON
        $servicesAvailed = json_encode($request->services_availed ?? []);


        // $cetfBalance = ($request->cetf_required ?? 0) - ($request->total_remittance ?? 0);

        // Create the cooperative entry
        $cooperative = Cooperative::create([
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'type' => $request->type,
            'address' => $request->address,
            'no_of_entitled_votes' => $votes, // Use the calculated votes
            'region' => $request->region,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'tin' => $request->tin,
            'fs_status' => $request->fs_status,
            'delinquent'  => $request->delinquent,
            'coop_identification_no' => $request->coop_identification_no,
            'bod_chairperson' => $request->bod_chairperson,
            'general_manager_ceo' => $request->general_manager_ceo,
            'total_asset' => $request->total_asset,
            'loan_balance' => $request->loan_balance,
            'total_overdue' => $request->total_overdue,
            'time_deposit' => $request->time_deposit,
            'accounts_receivable' => $request->accounts_receivable,
            'savings' => $request->savings,
            'net_surplus' => $request->net_surplus,
            'cetf_due_to_apex' => $request->cetf_due_to_apex,
            'additional_cetf' => $request->additional_cetf,
            'cetf_undertaking' => $request->cetf_undertaking,
            'full_cetf_remitted' => $request->full_cetf_remitted,
            'registration_date_paid' => $request->registration_date_paid,
            'registration_fee' => $request->registration_fee,
            'total_income' => $request->total_income,
            'total_remittance' => $request->total_remittance,
            'ga_remark' => $request->ga_remark,
            'reg_fee_payable' => $request->reg_fee_payable,
            'net_required_reg_fee' => $request->net_required_reg_fee,
            'less_prereg_payment' => $request->less_prereg_payment,
            'less_cetf_balance' => $request->less_cetf_balance,
            'total_reg_fee' => $request->total_reg_fee,
            'cetf_remittance' => $request->cetf_remittance,
            'cetf_required' => $request->cetf_required,
            'cetf_balance' => $request->cetf_balance,
            'share_capital_balance' => $request->share_capital_balance,
            'services_availed' => $servicesAvailed,
            'other_services' => $request->other_services,
            'total_members' => $request->total_members,
            'regular_members' => $request->regular_members,
            'associate_members' => $request->associate_members,
            'date_registered' => $request->date_registered,
            'status' => $request->status,
            'affiliated_orgs' => $request->affiliated_orgs
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
        $coop = Cooperative::findOrFail($coop_id);

        $hasFinancialStatement = UploadedDocument::where('coop_id', $coop->coop_id)
            ->where('document_type', 'Financial Statement')
            ->where('status', 'Approved')
            ->exists();

        // Check if cooperative has MIGS membership
        $hasMigsRegistration = GARegistration::where('coop_id', $coop->coop_id)
            ->where('membership_status', 'MIGS')
            ->exists();

        // Check if cooperative has an MSP Officer participant
        $hasMspOfficer = Participant::where('coop_id', $coop->coop_id)
            ->where('is_msp_officer', true)
            ->exists();

        $coop->cetf_balance = ($coop->cetf_required ?? 0) - ($coop->total_remittance ?? 0);
        // Check the total remittance
        $totalRemittance = $coop->total_remittance ?? 0;
        $free100kCETF = $totalRemittance >= 100000; // Free 1 pax if remittance >= 100K
        $halfBasedCETF = $totalRemittance >= 50000; // Free 1 pax if remittance >= 50K

        // Get the number of participants
        $numParticipants = $coop->participants()->count();

        // Calculate the number of free participants
        $freeParticipants = 0;
        if ($hasMigsRegistration) {
            $freeParticipants += 2; // Free 2 participants for MIGS
        }
        if ($hasMspOfficer) {
            $freeParticipants += 1;
        }
        if ($free100kCETF) {
            $freeParticipants += 1;
        }
        if ($halfBasedCETF) {
            $numParticipants = max(0, $numParticipants - 1); // Discount 1 participant by 50%
        }

        $paidParticipants = max($numParticipants - $freeParticipants, 0);

        // Calculate total registration fee
        $registrationFee = $coop->registration_fee ?? 0;
        $totalRegFee = $paidParticipants * $registrationFee;

        // Calculate registration fee payable
        $netRequiredRegFee = $coop->net_required_reg_fee ?? 0;
        $lessPreregPayment = $coop->less_prereg_payment ?? 0;
        $lessCetfBalance = $coop->less_cetf_balance ?? 0;

        $regFeePayable = max(0, $netRequiredRegFee - ($lessPreregPayment + $lessCetfBalance));

        // Store values in the model
        $coop->total_reg_fee = $totalRegFee;
        $coop->reg_fee_payable = $regFeePayable;

        return view('dashboard.admin.edit', compact(
            'coop',
            'hasMigsRegistration',
            'hasMspOfficer',
            'free100kCETF',
            'halfBasedCETF',
            'hasFinancialStatement'
        ));
    }

    public function updateStatus(Request $request, $coop_id)
    {
        // Validate inputs
        $request->validate([
            'registration_status' => 'nullable|in:Partial Registered,Fully Registered,Rejected',
            'membership_status' => 'nullable|in:Non-migs,Migs',
        ]);

        // Find or create GA Registration for the Cooperative
        $gaRegistration = GARegistration::firstOrCreate(
            ['coop_id' => $coop_id],
            ['participant_id' => null] // Ensure participant_id is handled
        );

        // Update only if values are provided
        if ($request->filled('registration_status')) {
            $gaRegistration->registration_status = $request->registration_status;
        }
        if ($request->filled('membership_status')) {
            $gaRegistration->membership_status = $request->membership_status;
        }

        $gaRegistration->save();

        return back()->with('success', 'GA Registration status updated successfully.');
    }

    public function update(Request $request, $coop_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'general_manager_ceo' => 'nullable|string|max:255',
            'bod_chairperson' => 'nullable|string|max:255',
            'coop_identification_no' => 'nullable|string|max:255',
            'region' => [
                'required',
                Rule::in([
                    'Region I',
                    'Region II',
                    'Region III',
                    'Region IV-A',
                    'Region IV-B',
                    'Region V',
                    'Region VI',
                    'Region VII',
                    'Region VIII',
                    'Region IX',
                    'Region X',
                    'Region XI',
                    'Region XII',
                    'Region XIII',
                    'NCR',
                    'CAR',
                    'BARMM',
                    'ZBST',
                    'LUZON'
                ]),
            ],
            'phone_number' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('participants', 'email'),
                Rule::unique('cooperatives', 'email')->ignore($coop_id, 'coop_id'),
            ],
            'tin' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'fs_status' => ['nullable', Rule::in(['yes', 'no'])],
            'delinquent' => ['nullable', Rule::in(['yes', 'no'])],

            // Numeric Fields
            'total_asset' => 'nullable|numeric|min:0',
            'loan_balance' => 'nullable|numeric|min:0',
            'total_overdue' => 'nullable|numeric|min:0',
            'time_deposit' => 'nullable|numeric|min:0',
            'accounts_receivable' => 'nullable|numeric|min:0',
            'savings' => 'nullable|numeric|min:0',
            'net_surplus' => 'nullable|numeric|min:0',
            'cetf_due_to_apex' => 'nullable|numeric|min:0',
            'additional_cetf' => 'nullable|numeric|min:0',
            'cetf_undertaking' => 'nullable|numeric|min:0',
            'total_income' => 'nullable|numeric|min:0',
            'cetf_remittance' => 'nullable|numeric|min:0',
            'cetf_required' => 'nullable|numeric|min:0',
            'cetf_balance' => 'nullable|numeric',
            'total_remittance' => 'nullable|numeric|min:0',
            'net_required_reg_fee' => 'nullable|numeric',
            'total_reg_fee' => 'nullable|numeric|min:0',
            'share_capital_balance' => 'nullable|numeric|min:0',
            'less_prereg_payment' => 'nullable|numeric|min:0',
            'less_cetf_balance' => 'nullable|numeric|min:0',
            'free_migs_pax' => 'nullable|numeric|min:0',

            // Other Fields
            'full_cetf_remitted' => ['nullable', Rule::in(['yes', 'no'])],
            'registration_date_paid' => 'nullable|date',
            'registration_fee' => 'nullable|numeric|min:0',
            'ga_remark' => 'nullable|string|max:255',
            'no_of_entitled_votes' => 'nullable|integer|min:0',
            'services_availed' => 'nullable|array',
            'services_availed.*' => 'string|max:255',
        ]);

        // Convert numeric values (remove commas)
        $numericFields = [
            'total_asset',
            'loan_balance',
            'total_overdue',
            'time_deposit',
            'accounts_receivable',
            'savings',
            'net_surplus',
            'cetf_due_to_apex',
            'additional_cetf',
            'cetf_undertaking',
            'total_income',
            'cetf_remittance',
            'cetf_required',
            'cetf_balance',
            'total_remittance',
            'net_required_reg_fee',
            'total_reg_fee',
            'share_capital_balance',
            'registration_fee',
            'less_prereg_payment',
            'free_migs_pax',
            'less_cetf_balance'
        ];

        foreach ($numericFields as $field) {
            $validated[$field] = $request->$field ? (float) str_replace(',', '', $request->$field) : null;
        }

        $netRequiredRegFee = $validated['net_required_reg_fee'] ?? 0;
        $lessPreregPayment = $validated['less_prereg_payment'] ?? 0;
        $lessCetfBalance = $validated['less_cetf_balance'] ?? 0;


        $validated['reg_fee_payable'] = $netRequiredRegFee - ($lessPreregPayment + $lessCetfBalance);

        // ✅ Calculate `no_of_entitled_votes`
        $share_capital = $validated['share_capital_balance'] ?? 0;
        $votes = 0;

        if ($share_capital >= 100000) {
            $votes += floor($share_capital / 100000);
        }

        $validated['cetf_balance'] = ($validated['cetf_required'] ?? 0) - ($validated['total_remittance'] ?? 0);
        $validated['delinquent'] = $request->input('delinquent');

        $remaining = $share_capital % 100000;

        while ($remaining >= 25000) {
            if ($remaining >= 75000) {
                $votes += 3;
                $remaining -= 75000;
            } elseif ($remaining >= 50000) {
                $votes += 2;
                $remaining -= 50000;
            } elseif ($remaining >= 25000) {
                $votes += 1;
                $remaining -= 25000;
            }
        }

        $validated['no_of_entitled_votes'] = min($votes, 5);

        // Convert services_availed array to JSON
        $validated['services_availed'] = isset($request->services_availed)
            ? json_encode($request->services_availed)
            : json_encode([]);

        // ✅ Update the cooperative
        $coop = Cooperative::findOrFail($coop_id);
        $coop->update($validated);

        // ✅ Update linked user
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
            'coop_id' => [
                'nullable', // Allow it to be empty
                Rule::requiredIf(!in_array($request->role, ['admin', 'support'])), // Required unless role is admin or support
                'exists:cooperatives,coop_id'
            ],
            'role' => ['required', Rule::in(['participant', 'admin', 'cooperative', 'support'])], // Added 'support'
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
