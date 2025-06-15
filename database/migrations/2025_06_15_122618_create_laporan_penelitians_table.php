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
            $table->string('kode_seri');
            $table->string('judul_penelitian');
            $table->string('peneliti');
            $table->foreignId('skema')->constrained('skema_penelitians')->onDelete('cascade');
            $table->string('anggota');
            $table->foreignId('jurusan')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('prodi')->constrained('prodis')->onDelete('cascade');
            $table->date('tanggal_laporan_diterima')->nullable();
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