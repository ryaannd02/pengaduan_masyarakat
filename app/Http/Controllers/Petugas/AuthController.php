<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('petugas.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek user di tabel petugas
        $petugas = DB::table('tb_petugas')
            ->where('username', $credentials['username'])
            ->first();

        // Jika tidak ditemukan atau password salah
        if (!$petugas || !Hash::check($credentials['password'], $petugas->password)) {
            return back()
                ->withInput(['username' => $credentials['username']])
                ->with('error', 'Username atau password salah.');
        }

        // Simpan sesi login
        $request->session()->put('petugas', [
            'id_petugas'   => $petugas->id_petugas,
            'nama_petugas' => $petugas->nama_petugas,
            'username'     => $petugas->username,
            'level'        => $petugas->level,
        ]);

        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Redirect jika sebelumnya ada halaman intended
        $intended = $request->session()->pull('intended');
        if ($intended) {
            return redirect()->to($intended);
        }

        // Arahkan sesuai level
        if ($petugas->level === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('petugas.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('petugas');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('petugas.login')
            ->with('success', 'Anda telah logout.');
    }
}