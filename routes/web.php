<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;


Route::get('/', function () {
    return view('homepage');
})->name('homelanding');

// Registration page
Route::get('/register', function () {
    return view('registration');
})->name('register');

// Route to fetch the sign-in modal
Route::get('/signin-modal', function () {
    return view('modals.signin_modal');
});

// Customer registration
Route::post('/register/customer', [CustomerController::class, 'register'])->name('register.customer');

// Business registration
Route::post('/register/business', [BusinessController::class, 'register'])->name('register.business');

// Customer login (POST) — handled by CustomerController
Route::post('/login/customer', [CustomerController::class, 'login'])->name('login.customer');

// Business login (POST) — handled by BusinessController
Route::post('/login/business', [BusinessController::class, 'login'])->name('login.business');