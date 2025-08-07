<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'https://propersix.casino/api/user/backend_status_update',
        'https://propersix.casino/coin_callback',
        'http://dev.casino/payment_callback',
        'https://propersix.casino/payment_callback',
        'https://propersix.casino/payment-back',
        'https://propersix.casino/user/payment-setting',
        // softswiss games callback url
        'https://propersix.casino/play',
        'https://propersix.casino/rollback',
        'https://propersix.casino/api/session-closed',
        'http://54.151.49.67/play',
        'http://54.151.49.67/rollback',
        'http://54.151.49.67/api/session-closed'
    ];
}
