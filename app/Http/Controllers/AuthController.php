<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        $cooperatives = Cooperative::all(); // Fetch all cooperatives
        return view('auth.login', compact('cooperatives'));
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
            return $this->redirectToDashboard();
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'coop_id' => 'required|exists:cooperatives,coop_id'
        ]);

        $cooperative = Cooperative::find($request->coop_id);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'coop_id' => $request->coop_id,
            'cooperative' => $cooperative->name,
            'role' => 'participant', // Default role set to participant
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully');
    }

    private function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('adminDashboard')->with('success', 'Welcome, Admin!');
        } elseif ($user->role === 'participant') {
            return redirect()->route('userDashboard')->with('success', 'Welcome to your dashboard!');
        }

        return redirect('/login')->withErrors(['email' => 'Unauthorized role. Contact support.']);
    }
}
