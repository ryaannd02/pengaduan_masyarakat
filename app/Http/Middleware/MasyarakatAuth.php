<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MasyarakatAuth
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('masyarakat')) {
            return redirect()->route('masyarakat.dashboard');
        }
        return $next($request);
    }
}