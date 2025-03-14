<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrSupportMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Allow both Admins and Support to pass through
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'support')) {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
    }
}
