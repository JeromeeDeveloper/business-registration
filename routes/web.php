<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
