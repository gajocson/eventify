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

// Login
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
})->name('login');