<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('judul_penelitian');
            $table->string('peneliti');
            $table->string('jurusan');
            $table->year('tahun_penelitian');
            $table->date('tanggal_laporan_diterima')->nullable();
            $table->enum('status_laporan', ['proses', 'selesai'])->default('proses');
            $table->string('file')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penelitians');
    }
};
