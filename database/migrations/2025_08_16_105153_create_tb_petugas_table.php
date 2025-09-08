<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_tb_petugas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama_petugas', 100);
            $table->string('username', 50)->unique();
            $table->string('password'); // bcrypt hash
            $table->string('telp', 20)->nullable();
            $table->enum('level', ['petugas', 'admin'])->default('petugas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_petugas');
    }
};