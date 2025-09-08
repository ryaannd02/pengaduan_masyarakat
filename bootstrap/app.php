<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.petugas'     => \App\Http\Middleware\PetugasAuth::class,
            'auth.masyarakat'  => \App\Http\Middleware\AuthMasyarakatMiddleware::class,
            'guest.masyarakat' => \App\Http\Middleware\MasyarakatAuth::class, // opsional
            'admin'            => \App\Http\Middleware\AdminMiddleware::class, // 🔹 alias baru
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();