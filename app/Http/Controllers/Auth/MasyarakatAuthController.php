<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;

class MasyarakatAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('masyarakat.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/masyarakat/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/masyarakat/login');
    }
}