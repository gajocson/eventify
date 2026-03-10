<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;

// ─── Public pages ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('homepage');
});

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/packages', function () {
    return view('homepage'); // swap with packages view when ready
})->name('packages');

// ─── Registration ──────────────────────────────────────────────────────────────
Route::post('/register/customer', [CustomerController::class, 'register'])->name('register.customer');

// ─── Authentication ────────────────────────────────────────────────────────────
Route::post('/auth/login',  [AuthController::class, 'login'])->name('login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/user',    [AuthController::class, 'authUser'])->name('auth.user');

// ─── Customer-only routes ──────────────────────────────────────────────────────
Route::middleware(['auth:customer', 'customer.only'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/booking', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    // Profile settings
    Route::patch('/profile/phone',    [ProfileController::class, 'updatePhone'])->name('profile.phone');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // User replies to admin messages
    Route::post('/profile/bookings/{id}/reply', [MessageController::class, 'userReply'])->name('profile.booking.reply');
});

// ─── Admin-only routes ─────────────────────────────────────────────────────────
Route::middleware(['auth:customer', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/admin/bookings/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.booking.status');

    // Messaging (now handled by MessageController)
    Route::patch('/admin/bookings/{id}/message',  [MessageController::class, 'adminSend'])->name('admin.booking.message');
    Route::get('/admin/bookings/{id}/messages',   [MessageController::class, 'adminThread'])->name('admin.booking.messages');
});