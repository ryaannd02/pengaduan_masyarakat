<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... biarkan default lainnya

    protected $routeMiddleware = [
        // ...
        'auth' => \App\Http\Middleware\Authenticate::class,
        // ...
    ];
}