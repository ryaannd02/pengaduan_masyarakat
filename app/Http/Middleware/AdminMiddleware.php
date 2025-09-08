<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $petugas = Session::get('petugas');

        if ($petugas && $petugas['level'] === 'admin') {
            return $next($request);
        }

        abort(403, 'Forbidden');
    }
}