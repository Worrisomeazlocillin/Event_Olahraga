<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
    'auth' => \App\Filters\AuthFilter::class,
    ];

    public $globals = [
        'before' => [],
        'after'  => [],
    ];

    public $methods = [];

    public $filters = [
        'auth' => [
            'before' => [
                'dashboard/*', // Membutuhkan autentikasi
            ],
        ],
    ];
}
