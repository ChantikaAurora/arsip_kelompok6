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
        Schema::create('proposal_pusat_penelitians', function (Blueprint $table) {
           $table->id();
            $table->string('no');
            $table->string('kode_klasifikasi');
            $table->string('judul');
            $table->string('peneliti');
            $table->unsignedBigInteger('skema_penelitian_id');
            $table->string('anggota')->nullable();
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('prodi_id');
            $table->date('tanggal_pengajuan');
            $table->text('keterangan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('skema_penelitian_id')->references('id')->on('skema_penelitians')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_pusat_penelitians');
    }
};
