<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Business;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed 10 customers with fake data
        Customer::factory(10)->create();

        // Seed 5 businesses with fake data
        Business::factory(5)->create();

        // Create default admin account
        $this->call(AdminSeeder::class);
    }
}