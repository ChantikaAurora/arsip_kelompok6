<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_pengabdian', function (Blueprint $table) {
            $table->id();
            $table->string('kode_seri');
            $table->string('judul');
            $table->string('peneliti');
            $table->string('skema');
            $table->text('anggota')->nullable();
            $table->unsignedBigInteger('jurusan_id'); // penting: harus unsignedBigInteger
            $table->unsignedBigInteger('prodi_id');   // penting: harus unsignedBigInteger
            $table->date('tanggal_pengajuan');
            $table->string('file')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key relasi ke jurusan dan prodi
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_pengabdian');
    }
};
