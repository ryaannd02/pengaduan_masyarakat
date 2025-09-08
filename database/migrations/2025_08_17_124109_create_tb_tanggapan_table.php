<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_tanggapan', function (Blueprint $table) {
            $table->bigIncrements('id_tanggapan');
            $table->unsignedBigInteger('id_pengaduan');
            $table->dateTime('tgl_tanggapan');
            $table->text('tanggapan');
            $table->unsignedBigInteger('id_petugas');

            // Index + foreign key (sesuaikan nama & PK tabel terkait)
            $table->foreign('id_pengaduan')
                  ->references('id_pengaduan')->on('tb_pengaduan')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_petugas')
                  ->references('id_petugas')->on('tb_petugas')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_tanggapan');
    }
};