<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'tb_pengaduan'; // WAJIB: nama tabel sesuai DB
    protected $primaryKey = 'id_pengaduan'; // sesuaikan dengan struktur tabel
    public $incrementing = true;
    public $timestamps = true; // jika tabel tidak punya created_at & updated_at

    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status',
    ];
}
