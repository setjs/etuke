<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'administrator' => [
            'driver' => 'session',
            'provider' => 'administrators',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],



    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class,
        ],

        'administrators' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Administrator::class,
        ],
    ],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
