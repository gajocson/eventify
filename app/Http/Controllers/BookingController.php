<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show the booking page with selected package and services.
     */
    public function show(Request $request)
    {
        $package  = $request->input('package', '');
        $services = $request->input('services', []);

        // Ensure services is always an array
        if (!is_array($services)) {
            $services = [$services];
        }

        return view('booking', [
            'package'  => $package,
            'services' => $services,
        ]);
    }
}
