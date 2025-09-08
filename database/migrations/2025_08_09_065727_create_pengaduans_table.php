<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->date('tgl_pengaduan');
            $table->char('nik', 16);
            $table->text('isi_laporan');
            $table->string('foto', 255);
            $table->enum('status', ['belum diproses', 'proses', 'selesai'])->default('belum diproses');
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('tb_masyarakat')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pengaduan');
    }
};