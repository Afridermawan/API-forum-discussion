<?php

$phpdotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$phpdotenv->load();

return [
    'settings' => [

        // Show error
        'displayErrorDetails' => true,

        // Validator
        'lang' => [
            'default' => 'id',
        ],

        // Twig View
        'view' => [
            'template_path' => __DIR__ . '/../views',
            'twig' => [
                'cache' => false,
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // Elloquent
        'db' => [
            'driver'    => $_ENV['DB_DRIVER'],
            'host'      => $_ENV['DB_HOST'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];
