<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::latest()->paginate(10);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:tb_petugas',
            'telp'         => 'required|string|max:15',
            'password'     => 'required|string|min:6',
            'level'        => 'required|in:admin,petugas', // ✅ validasi level
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username'     => $request->username,
            'telp'         => $request->telp,
            'password'     => bcrypt($request->password),
            'level'        => $request->level, // ✅ simpan level
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Petugas::findOrFail($id)->delete();
        return back()->with('success', 'Akun petugas berhasil dihapus');
    }
}