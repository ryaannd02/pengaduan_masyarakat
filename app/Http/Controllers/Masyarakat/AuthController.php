<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('masyarakat.registrasi');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:tb_masyarakat,nik',
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:25|unique:tb_masyarakat,username',
            'password' => 'required|string|min:6|confirmed',
            'telp' => 'required|regex:/^\d{10,13}$/',
        ]);

        DB::table('tb_masyarakat')->insert([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'telp' => $request->telp,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('masyarakat.login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        return view('masyarakat.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
            'password' => 'required|string',
        ]);

        $user = DB::table('tb_masyarakat')->where('nik', $request->nik)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // simpan data penting ke session
            $request->session()->put('masyarakat', [
                'nik' => $user->nik ?? null,
                'nama' => $user->nama,
                'username' => $user->username,
            ]);

            // regenerate session id
            $request->session()->regenerate();

            // redirect ke intended kalau ada
            $intended = $request->session()->pull('intended');
            return $intended
                ? redirect()->to($intended)
                : redirect()->route('masyarakat.dashboard');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('masyarakat');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masyarakat.login')->with('success', 'Anda telah logout.');
    }
}