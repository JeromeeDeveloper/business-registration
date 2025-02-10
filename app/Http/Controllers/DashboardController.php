<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    // Show the admin dashboard view
    public function admin()
    {
        $totalParticipants = Participant::count(); // Get total participants
        $totalUsers = User::count(); // Get total users

        return view('dashboard.admin.admin', compact('totalParticipants', 'totalUsers'));
    }


    public function participant()
    {

        $user = Auth::user();

        $participant = $user->participant()->with('cooperative')->first();


        if (!$participant || !$participant->cooperative) {
            return view('dashboard.participant.participant', ['participant' => null]);
        }

        return view('dashboard.participant.participant', compact('participant'));
    }


    public function cooperativeprofile($participant_id, $cooperative_id)
    {

        $participant = Participant::findOrFail($participant_id);
        $cooperative = Cooperative::findOrFail($cooperative_id);

        return view('dashboard.participant.cooperativeprofile', compact('participant', 'cooperative'));
    }

    public function editCooperativeProfile($participant_id, $cooperative_id)
    {
        // Fetch the participant details using the ID
        $participant = Participant::findOrFail($participant_id);
        $cooperative = Cooperative::findOrFail($cooperative_id);
        // Return the edit view with participant data
        return view('dashboard.participant.edit', compact('participant', 'cooperative'));
    }

    public function updateCooperativeProfile(Request $request, $participant_id, $coop_id)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'phone_number' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'congress_type' => 'nullable|string|max:255',
            'religious_affiliation' => 'nullable|string|max:255',
            'tshirt_size' => 'nullable|in:XS,S,M,L,XL,XXL,XXXL',
            'is_msp_officer' => 'required|in:Yes,No', // Ensures only 'Yes' or 'No' are allowed
            'msp_officer_position' => 'nullable|string|max:255',
            'delegate_type' => 'required|in:Voting,Non-Voting',
        ]);

        // Find the participant by ID
        $participant = Participant::findOrFail($participant_id);

        // Update the participant record
        $participant->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'designation' => $request->designation,
            'congress_type' => $request->congress_type,
            'religious_affiliation' => $request->religious_affiliation,
            'tshirt_size' => $request->tshirt_size,
            'is_msp_officer' => $request->is_msp_officer,
            'msp_officer_position' => $request->msp_officer_position,
            'delegate_type' => $request->delegate_type,
        ]);

        // Redirect back with a success message
        return redirect()->route('cooperativeprofile', ['participant_id' => $participant_id, 'coop_id' => $participant->coop_id])
                         ->with('success', 'Participant profile updated successfully!');
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
    Participant::create($validatedData);

    return redirect()->route('participant.register')->with('success', 'Participant registered successfully!');
}

    // Show the cooperative registration form
    public function register()
    {
        return view('dashboard.admin.register');
    }

    public function view(Request $request)
{
    // Get search query from request
    $search = $request->input('search');

    // Fetch cooperatives with search filtering and sorting by created_at (latest first)
    $cooperatives = Cooperative::where('name', 'LIKE', "%{$search}%")
        ->orWhere('type', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('address', 'LIKE', "%{$search}%")
        ->orderBy('created_at', 'desc') // Sort by created_at (latest first)
        ->paginate(3); // Keep pagination

    // Return view with search query
    return view('dashboard.admin.datatable', compact('cooperatives', 'search'));
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
            'email' => 'required|email',
            'tin' => 'required|string|max:255',
            'coop_identification_no' => 'required|string|max:255',
            'bod_chairperson' => 'required|string|max:255',
            'general_manager_ceo' => 'required|string|max:255',
            'ga_registration_status' => 'required|string|max:255',
            'total_asset' => 'required|numeric',
            'total_income' => 'required|numeric',
            'cetf_remittance' => 'required|numeric',
            'cetf_required' => 'required|numeric',
            'cetf_balance' => 'required|numeric',
            'share_capital_balance' => 'required|numeric',
            'no_of_entitled_votes' => 'required|numeric',
            'services_availed' => 'required|string|max:255',
        ]);

        // Create a new cooperative entry
        Cooperative::create([
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
            'ga_registration_status' => $request->ga_registration_status,
            'total_asset' => $request->total_asset,
            'total_income' => $request->total_income,
            'cetf_remittance' => $request->cetf_remittance,
            'cetf_required' => $request->cetf_required,
            'cetf_balance' => $request->cetf_balance,
            'share_capital_balance' => $request->share_capital_balance,
            'no_of_entitled_votes' => $request->no_of_entitled_votes,
            'services_availed' => $request->services_availed,
        ]);


        return response()->json(['success' => 'Cooperative registered successfully!']);
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
        'email' => 'required|email',
        'address' => 'required|string|max:255',
    ]);

    // Find the cooperative by its ID and update the details
    $coop = Cooperative::findOrFail($coop_id);
    $coop->update($validated);

    // Redirect to the cooperatives page with a success message
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'participant',
        ]);

        Auth::login($user);

        return redirect()->route('users.index')->with('success', 'Registration successful');
    }

    public function registerform()
    {
        return view('dashboard.admin.user.register');
    }

    }

