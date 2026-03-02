<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Default guard and password broker for your application.
    |
    */

    'defaults' => [
        'guard' => 'customer', // default guard
        'passwords' => 'customers', // default password broker
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Define guards for customers and businesses.
    |
    */

    'guards' => [
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],

        'business' => [
            'driver' => 'session',
            'provider' => 'businesses',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Define which models each guard uses.
    |
    */

    'providers' => [
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],

        'businesses' => [
            'driver' => 'eloquent',
            'model' => App\Models\Business::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Password reset tables for customers and businesses.
    |
    */

    'passwords' => [
        'customers' => [
            'provider' => 'customers',
            'table' => 'customer_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'businesses' => [
            'provider' => 'businesses',
            'table' => 'business_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Time in seconds before password confirmation expires.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];