<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * GET /admin/dashboard
     * Protected by auth:customer + admin middleware.
     */
    public function dashboard()
    {
        $admin = Auth::guard('customer')->user();
        return view('admin.dashboard', compact('admin'));
    }
}
