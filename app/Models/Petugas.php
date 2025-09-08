<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_petugas'; // ⚠ WAJIB disamakan dengan tabel asli di DB
    protected $primaryKey = 'id_petugas'; // Pastikan PK sesuai migrasi
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}