<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $statusInput = $request->get('status');
        $map = [
            'belum'           => 'belum diproses',
            'belum diproses'  => 'belum diproses',
            'proses'          => 'proses',
            'selesai'         => 'selesai',
            // 'ditolak' sengaja tidak dipakai lagi
        ];
        $status = $map[strtolower((string)$statusInput)] ?? 'belum diproses';

        $show = (int) $request->get('show', 10);
        $q    = trim((string) $request->get('q', ''));

        $pengaduan = DB::table('tb_pengaduan as p')
            ->leftJoin('tb_masyarakat as m', 'm.nik', '=', 'p.nik')
            ->select('p.id_pengaduan','p.isi_laporan','p.status','p.created_at','m.nama')
            ->where('p.status', $status)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('m.nama', 'like', "%{$q}%")
                      ->orWhere('p.isi_laporan', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('p.created_at')
            ->paginate($show)
            ->withQueryString();

        return view('petugas.pengaduan.index', [
            'pengaduan'   => $pengaduan,
            'statusLabel' => $status
        ]);
    }

    public function show($id)
    {
        // Pastikan ini mencari berdasarkan kolom id_pengaduan
        $pengaduan = Pengaduan::where('id_pengaduan', $id)->firstOrFail();

        // Opsi status TANPA 'ditolak'
        $status = ['proses', 'selesai'];

        return view('petugas.pengaduan.show', compact('pengaduan', 'status'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi TANPA 'ditolak'
        $request->validate([
            'status'    => 'required|in:proses,selesai',
            'tanggapan' => 'required|string|max:1000',
        ]);

        $petugas = session('petugas');
        if (!$petugas) {
            abort(401, 'Petugas belum login');
        }

        DB::transaction(function () use ($request, $id, $petugas) {
            // Cari berdasarkan id_pengaduan agar tidak tergantung primaryKey model
            $pengaduan = Pengaduan::where('id_pengaduan', $id)->firstOrFail();

            $pengaduan->status = strtolower($request->status);
            $pengaduan->save();

            // Timpa / buat tanggapan terbaru untuk pengaduan ini
            Tanggapan::updateOrCreate(
                ['id_pengaduan' => $pengaduan->id_pengaduan],
                [
                    'tgl_tanggapan' => now(),
                    'tanggapan'     => $request->tanggapan,
                    'id_petugas'    => $petugas['id_petugas'],
                ]
            );
        });

        return redirect()
            ->route('petugas.pengaduan.show', $id)
            ->with('success', 'Status dan tanggapan berhasil diperbarui');
    }
}