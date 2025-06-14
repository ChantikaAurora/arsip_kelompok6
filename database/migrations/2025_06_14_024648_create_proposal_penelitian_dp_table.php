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
        Schema::create('proposal_penelitian_dp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_seri')->unique();
            $table->string('judul');
            $table->string('peneliti');
            $table->string('skema');
            $table->string('anggota')->nullable();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
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
        Schema::dropIfExists('proposal_penelitian_dp');
    }
};