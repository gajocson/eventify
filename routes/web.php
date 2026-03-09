<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AuthController;

// ─── Public pages ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('homepage');
});

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/packages', function () {
    return view('homepage'); // swap with packages view when ready
})->name('packages');

// ─── Registration ─────────────────────────────────────────────────────────────
Route::get('/registration-modal', function () {
    return view('modals.registration_modal');
});

Route::post('/register/customer', [CustomerController::class, 'register'])->name('register.customer');
Route::post('/register/business', [BusinessController::class, 'register'])->name('register.business');

// ─── Authentication ───────────────────────────────────────────────────────────
Route::post('/auth/login',  [AuthController::class, 'login'])->name('login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/user',    [AuthController::class, 'authUser'])->name('auth.user');

// ─── Protected routes (require customer login) ────────────────────────────────
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});