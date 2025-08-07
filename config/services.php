<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => '263967045272673',  // Your Facebook App ID
        'client_secret' => 'c2874f72ec68e4a5d4b4c20719997717', // Your Facebook App Secret
        'redirect' => 'https://propersix.casino/login/facebook/callback',
    ],
    'instagram' => [
        'client_id' => '4131527800199934',
        'client_secret' => 'ccf18d0827a2b3f6ec973ffb3fbfc51c',
        'redirect' => 'https://propersix.casino/instagram-callback',
    ],
    'twitter' => [
        'client_id' => 'Mj5o0KOwaQtQ5a4blXqapxpX4',  // Your Twitter Client ID
        'client_secret' => 'l7daQaAi1JTq0G5XsKD1DFOU524In9UMkEYW9em3v4WLPWzl6e', // Your Twitter Client Secret
        'redirect' => 'https://propersix.casino/login/twitter/callback',
    ],
    'linkedin' => [
        'client_id' => '77jgskda8g0vhn',
        'client_secret' => 'EtpCNH4FQfjPcOfz',
        'redirect' => 'https://propersix.casino/login/linkedin/callback',
    ],

    'google' => [
        'client_id'     => '346252984384-gc34nq3r0s1cochvpqhg1vnd0lbu8a43.apps.googleusercontent.com',
        'client_secret' => 'fjshnGWrMn1dmOSZLFeX2YoM',
        'redirect'      => 'https://propersix.casino/login/google/callback',
    ],
    'recaptcha' => [
        'key' => env('GOOGLE_RECAPTCHA_KEY'),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
    ],
    'affilka' => [
        'host' => 'propersix',
        'key' => env('AFFILKA_API_KEY','e1c905d14b869891a57c0740b3e3cb50'),
        'secret' => env('AFFILKA_API_SECRET','3ca38e8ef7166d44b7e4c0183898803576752d43cc7a442b67c0f1a6393e9959'),
    ],

];
