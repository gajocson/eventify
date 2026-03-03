<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Route to fetch the registration modal
Route::get('/registration-modal', function () {
    return view('modals.registration_modal');
});