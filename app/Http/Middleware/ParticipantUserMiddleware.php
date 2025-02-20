<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated and has the 'participant' role
        if (Auth::check() && Auth::user()->role === 'participant') {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
    }
}
