<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Create the default admin account.
     * Safe to run multiple times — checks before inserting.
     */
    public function run(): void
    {
        if (!Customer::where('email', 'Admin@gmail.com')->exists()) {
            Customer::create([
                'first_name' => 'Admin',
                'last_name'  => 'Eventify',
                'email'      => 'Admin@gmail.com',
                'password'   => Hash::make('Password'),
                'role'       => 'admin',
            ]);
        }
    }
}
