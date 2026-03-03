<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;


Route::get('/', function () {
    return view('homepage');
});

// Route to fetch the registration modal
Route::get('/registration-modal', function () {
    return view('modals.registration_modal');
});

// Customer registration
Route::post('/register/customer', [CustomerController::class, 'register'])->name('register.customer');

// Business registration
Route::post('/register/business', [BusinessController::class, 'register'])->name('register.business');