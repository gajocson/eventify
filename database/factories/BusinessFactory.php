<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Business;

class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        return [
            'business_name' => fake()->company(),
            'business_email' => fake()->unique()->safeEmail(),
            'business_cont_num' => fake()->phoneNumber(),
            'password' => Hash::make('password'),
        ];
    }
}