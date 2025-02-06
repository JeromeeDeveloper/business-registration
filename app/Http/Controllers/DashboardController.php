<?php

namespace App\Http\Controllers;

use App\Models\Cooperative;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // Show the admin dashboard view
    public function admin()
    {
        return view('dashboard.admin.admin');
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

        // Redirect back with success message
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

    }

