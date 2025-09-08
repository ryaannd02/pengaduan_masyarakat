<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    private const STATUS_BELUM_DIPROSES = 'belum diproses';

    public function index()
    {
        $nik = session('masyarakat.nik');

        $pengaduan = DB::table('tb_pengaduan')
            ->where('nik', $nik)
            ->orderByDesc('tgl_pengaduan')
            ->get();

        return view('masyarakat.dashboard', compact('pengaduan'));
    }

    public function create()
    {
        return view('masyarakat.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_pengaduan' => 'required|date',
            'isi_laporan'   => 'required|string',
            'foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $nik = session('masyarakat.nik');
        $fotoPath = $request->file('foto')->store('pengaduan', 'public');

        DB::table('tb_pengaduan')->insert([
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'nik'           => $nik,
            'isi_laporan'   => $request->isi_laporan,
            'foto'          => $fotoPath,
            'status'        => self::STATUS_BELUM_DIPROSES,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('masyarakat.pengaduan.index')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    public function show($id)
    {
        $nik = session('masyarakat.nik');

        $pengaduan = DB::table('tb_pengaduan as p')
            ->leftJoin('tb_tanggapan as t', 't.id_pengaduan', '=', 'p.id_pengaduan')
            ->where('p.id_pengaduan', $id)
            ->where('p.nik', $nik)
            ->select(
                'p.*',
                't.tanggapan as tanggapan_petugas',
                't.tgl_tanggapan'
            )
            ->first();

        if (!$pengaduan) {
            return redirect()
                ->route('masyarakat.pengaduan.index')
                ->with('error', 'Pengaduan tidak ditemukan.');
        }

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $nik = session('masyarakat.nik');

        $pengaduan = DB::table('tb_pengaduan')
            ->where('id_pengaduan', $id)
            ->where('nik', $nik)
            ->first();

        if (!$pengaduan) {
            return redirect()->route('masyarakat.pengaduan.index')->with('error', 'Pengaduan tidak ditemukan.');
        }

        $request->validate([
            'tgl_pengaduan' => 'required|date',
            'isi_laporan'   => 'required|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'isi_laporan'   => $request->isi_laporan,
            'updated_at'    => now(),
        ];

        if ($request->hasFile('foto')) {
            if (!empty($pengaduan->foto)) {
                Storage::disk('public')->delete($pengaduan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        DB::table('tb_pengaduan')
            ->where('id_pengaduan', $id)
            ->update($data);

        return redirect()->route('masyarakat.pengaduan.show', $id)
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nik = session('masyarakat.nik');

        $pengaduan = DB::table('tb_pengaduan')
            ->where('id_pengaduan', $id)
            ->where('nik', $nik)
            ->first();

        if (!$pengaduan) {
            return redirect()->route('masyarakat.pengaduan.index')->with('error', 'Pengaduan tidak ditemukan.');
        }

        if (!empty($pengaduan->foto)) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        DB::table('tb_pengaduan')->where('id_pengaduan', $id)->delete();

        return redirect()->route('masyarakat.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}