<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('homepage');
});

Route::get('/hosts', function () {
    return view('hosts');
});


// Route to fetch the registration modal
Route::get('/registration-modal', function () {
    return view('modals.registration_modal');
});

// Customer registration
Route::post('/register/customer', [CustomerController::class, 'register'])->name('register.customer');

// Business registration
Route::post('/register/business', [BusinessController::class, 'register'])->name('register.business');

// Login / Logout
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');