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
        Schema::create('laporanakhirpenelitians', function (Blueprint $table) {
            $table->uuid('id_laporan_akhir')->primary(); // UUID sebagai primary key
            $table->string('judul_kegiatan');
            $table->string('skema');
            $table->year('tahun_pelaksanaan');
            $table->string('file')->nullable(); // file path atau nama file, boleh null jika belum ada file
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporanakhirpenelitians');
    }
};
