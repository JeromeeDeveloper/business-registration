<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function participant()
    {
        return view('dashboard.user');
    }

    public function admin()
    {
        return view('dashboard.admin.admin');
    }

    public function register()
    {
        return view('dashboard.admin.register');
    }
}
