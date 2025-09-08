<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_masyarakat';
    protected $primaryKey = 'id_masyarakat'; // ✅ PK sesuai tabel

    public $incrementing = true; // ubah ke false kalau PK bukan auto increment
    protected $keyType = 'int';  // ubah ke 'string' kalau PK bukan integer

    protected $fillable = [
        'nik', 'nama', 'username', 'telp', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}