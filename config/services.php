<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '472685073340523',
        'client_secret' => '66f7133aedb55a619294ddcc38419ee9',
        'redirect' => 'https://localhost/ShoeShoeBackend/public/facebook/callback',
    ],

    'google' => [
        'client_id' => '851588212447-9o6vfep0r91fcqilbth1900igife0lnj.apps.googleusercontent.com',
        'client_secret' => 'Fds69rsIOHHUs16fL-vnDbLz',
        'redirect' => 'https://localhost/ShoeShoeBackend/public/google/callback',
    ],



];
