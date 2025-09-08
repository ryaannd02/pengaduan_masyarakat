<?php

// database/seeders/PetugasSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tb_petugas')->insert([
            'nama_petugas' => 'Petugas',
            'username'     => 'petugas',
            'password'     => Hash::make('petugas'), // ganti saat production
            'telp'         => '081234567890',
            'level'        => 'petugas',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
