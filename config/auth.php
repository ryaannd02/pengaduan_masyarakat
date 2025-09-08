<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        // Default guard Laravel
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard untuk masyarakat
        'masyarakat' => [
            'driver' => 'session',
            'provider' => 'masyarakat',
        ],

        // Guard untuk petugas
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        // Default provider Laravel
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider masyarakat
        'masyarakat' => [
            'driver' => 'eloquent',
            'model' => App\Models\Masyarakat::class,
        ],

        // Provider petugas
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class, // pastikan model ini ada
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'masyarakat' => [
            'provider' => 'masyarakat',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'petugas' => [
            'provider' => 'petugas',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];