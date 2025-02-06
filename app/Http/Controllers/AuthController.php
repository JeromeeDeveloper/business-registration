<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            return redirect()->route('adminDashboard')->with('success', 'Welcome back!');
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
            'role' => 'participant',
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

    public function user()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('layouts.adminnav', compact('user')); // Pass the user data to the view
    }
}
