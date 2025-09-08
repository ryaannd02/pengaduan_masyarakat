<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMasyarakatMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('masyarakat')) {
            if ($request->isMethod('get')) {
                $request->session()->put('intended', $request->fullUrl());
            }
            return redirect()->route('masyarakat.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}