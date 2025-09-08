<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PetugasAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('petugas')) {
            // Simpan URL tujuan agar bisa diarahkan kembali setelah login
            $request->session()->put('intended', $request->fullUrl());

            return redirect()->route('petugas.login')
                ->with('error', 'Silakan login terlebih dahulu sebagai petugas.');
        }

        return $next($request);
    }
}