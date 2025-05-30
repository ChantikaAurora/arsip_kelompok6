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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('peneliti');
            $table->string('jurusan');
            $table->string('jenis');
            $table->integer('tahun_pengajuan');
            $table->string('status');
            $table->date('tanggal_pengajuan');
            $table->decimal('dana_diajukan', 15, 2);
            $table->text('keterangan')->nullable();
            $table->text('deskripsi')->nullable(); // deskripsi masih dipakai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
