<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Get the authenticated user

            if ($user->role === 'admin') {
                return redirect()->route('adminDashboard')->with('success', 'Welcome back, Admin!');
            } elseif ($user->role === 'cooperative') {
                return redirect()->route('participantDashboard')->with('success', 'Welcome back!');
            } elseif ($user->role === 'participant') { // Add participant role
                return redirect()->route('participantViewerDashboard')->with('success', 'Welcome to your dashboard!');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid email or password.');
    }


    public function register(Request $request)
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
            'role' => 'cooperative',
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully');
    }

    // private function redirectToDashboard()
    // {
    //     $user = Auth::user();

    //     if ($user->role === 'admin') {
    //         return redirect()->route('adminDashboard')->with('success', 'Welcome, Admin!');
    //     } elseif ($user->role === 'participant') {
    //         return redirect()->route('userDashboard')->with('success', 'Welcome to your dashboard!');
    //     }

    //     return redirect('/login')->withErrors(['email' => 'Unauthorized role. Contact support.']);
    // }

    public function user()
    {
        $user = Auth::user(); // Get the authenticated user

        $cooperative = Cooperative::where('coop_id', $user->coop_id)->first();

        return view('layouts.adminnav', compact('user', 'cooperative')); // Pass the user data to the view
    }

    public function user2()
    {
        $user = Auth::user(); // Get the authenticated user

        $cooperative = Cooperative::where('coop_id', $user->coop_id)->first();

        return view('layouts.adminnav2', compact('user', 'cooperative')); // Pass the user data to the view
    }

    public function user3()
    {
        $user = Auth::user(); // Get the authenticated user

        $cooperative = Cooperative::where('coop_id', $user->coop_id)->first();

        return view('layouts.adminnav2', compact('user', 'cooperative')); // Pass the user data to the view
    }


    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('participant') // Eager-load participant relationship
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('role', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Increased pagination limit for better listing

        return view('dashboard.admin.user.datatable', compact('users'));
    }


    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $cooperatives = Cooperative::all(); // Get all cooperatives to display in the dropdown
        return view('dashboard.admin.user.edit', compact('user', 'cooperatives'));
    }

    public function update(Request $request, $user_id)
    {
    // Validate the incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user_id . ',user_id',
        'role' => 'required|string|in:cooperative,admin,participant',
        'coop_id' => 'required|exists:cooperatives,coop_id', // Validate coop_id exists in cooperatives table
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Find the user by user_id and update the details
    $user = User::findOrFail($user_id);

    $oldEmail = $user->email; // Store the old email to detect changes

    // Only update the password if it's provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password); // Hash the new password
    } else {
        // If no password is provided, don't include it in the update
        unset($validated['password']);
    }

    $user->coop_id = $request->coop_id;
    $user->update($validated);

    // Check if email has changed
    if ($oldEmail !== $validated['email']) {
        // Update participant email if they had the old email
        Participant::where('user_id', $user_id)
            ->where('email', $oldEmail)
            ->update(['email' => $validated['email']]);

        // Update cooperative email if it's linked by coop_id
        Cooperative::where('coop_id', $user->coop_id)
            ->where('email', $oldEmail)
            ->update(['email' => $validated['email']]);
    }

    // Redirect to the users page with a success message
    return redirect()->route('users.index')->with('success', 'User updated successfully!');
}


    public function editProfile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('dashboard.admin.myprofile', compact('user')); // Pass user data to the view
    }

    public function updateProfile(Request $request)
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
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }


}
