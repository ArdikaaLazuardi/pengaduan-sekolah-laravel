<?php

return [

    'defaults' => [
        'guard' => 'siswa',
        'passwords' => 'admins',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'siswas',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'siswas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'siswas' => [
            'provider' => 'siswas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];