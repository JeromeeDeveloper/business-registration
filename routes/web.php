<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Home Page
Route::view('/', 'home.index');

// Grouped routes for other pages
Route::view('/about', 'home.about');
Route::view('/agenda', 'home.agenda');
Route::view('/contact', 'home.contact');
Route::view('/detail', 'home.detail');
Route::view('/feature', 'home.feature');
Route::view('/participant', 'home.participant');

// Login Registration
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function () {Auth::logout();return redirect('/login');})->name('logout');


//store
Route::get('/Admin/Dashboard', [DashboardController::class, 'admin'])->name('adminDashboard');
Route::get('/Admin/Register/Cooperatives', [DashboardController::class, 'register'])->name('adminregister');
Route::post('/store-cooperative', [DashboardController::class, 'storeCooperative'])->name('admin.storeCooperative');
Route::get('/adminnav', [AuthController::class, 'user'])->name('user_data');

//view
Route::get('/Admin/Cooperatives', [DashboardController::class, 'view'])->name('adminview');
Route::delete('/admin/cooperatives/{coop_id}', [DashboardController::class, 'destroy'])->name('cooperatives.destroy');

//edit
Route::get('/admin/cooperatives/{coop_id}/edit', [DashboardController::class, 'edit'])->name('cooperatives.edit');
Route::put('/admin/cooperatives/{coop_id}', [DashboardController::class, 'update'])->name('cooperatives.update');
Route::get('/cooperatives/{id}', [DashboardController::class, 'show'])->name('cooperatives.show');

