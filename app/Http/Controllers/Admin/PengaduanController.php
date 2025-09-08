<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter status dari query string (?status=...)
        $status = $request->get('status', 'belum diproses');
        $statusLabel = $status;

        // Ambil query pencarian
        $search = $request->get('q');

        // Ambil jumlah per halaman
        $perPage = (int) $request->get('show', 10);

        // Query tabel pengaduan join dengan masyarakat
        $query = DB::table('tb_pengaduan')
            ->leftJoin('tb_masyarakat', 'tb_pengaduan.nik', '=', 'tb_masyarakat.nik')
            ->select('tb_pengaduan.*', 'tb_masyarakat.nama')
            ->where('status', $status);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tb_masyarakat.nama', 'like', "%{$search}%")
                  ->orWhere('tb_pengaduan.isi_laporan', 'like', "%{$search}%");
            });
        }

        $pengaduan = $query->orderBy('tb_pengaduan.created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.pengaduan.index', compact('pengaduan', 'statusLabel'));
    }

    public function show($id)
    {
        $pengaduan = DB::table('tb_pengaduan')
            ->leftJoin('tb_masyarakat', 'tb_pengaduan.nik', '=', 'tb_masyarakat.nik')
            ->select('tb_pengaduan.*', 'tb_masyarakat.nama')
            ->where('id_pengaduan', $id)
            ->first();

        if (!$pengaduan) {
            abort(404);
        }

        // Status pilihan untuk admin → hanya proses & selesai
        $status = ['proses', 'selesai'];

        return view('admin.pengaduan.show', compact('pengaduan', 'status'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'tanggapan' => 'required|string'
        ]);

        DB::table('tb_pengaduan')
            ->where('id_pengaduan', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        // Simpan tanggapan (opsional, kalau punya tabel tanggapan)
        DB::table('tb_tanggapan')->insert([
            'id_pengaduan' => $id,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => session('petugas.id_petugas'),
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

}