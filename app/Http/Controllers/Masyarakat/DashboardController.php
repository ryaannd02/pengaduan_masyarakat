<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $nik = session('masyarakat.nik');

        $pengaduan = DB::table('tb_pengaduan')
            ->where('nik', $nik)
            ->orderByDesc('tgl_pengaduan')
            ->get();

        return view('masyarakat.dashboard', compact('pengaduan'));
    }
}