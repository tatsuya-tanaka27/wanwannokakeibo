<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        // 以下を追加
        '1P_JAR',
        'laravel_session',
        'XSRF-TOKEN',
        'PHPSESSID'
    ];
}
