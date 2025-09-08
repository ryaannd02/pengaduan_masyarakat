<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'total'   => DB::table('tb_pengaduan')->count(),
            'belum'   => DB::table('tb_pengaduan')->where('status', 'belum diproses')->count(),
            'proses'  => DB::table('tb_pengaduan')->where('status', 'proses')->count(),
            'selesai' => DB::table('tb_pengaduan')->where('status', 'selesai')->count(),
        ];

        return view('petugas.dashboard', compact('counts'));
    }
}