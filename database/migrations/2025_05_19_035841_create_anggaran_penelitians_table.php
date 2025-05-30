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
        Schema::create('anggaran_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('judul_penelitian');
            $table->string('peneliti');
            $table->string('tahun');
            $table->integer('total_anggaran');
            $table->foreignId('jenis_arsip_id') // foreign key ke jenis_arsips
                    ->constrained('jenis_arsips')
                    ->onDelete('cascade'); //foreign key dari jenis arsip
            $table->string('rincian_anggaran');
            $table->string('status');
            $table->string('file');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_penelitians');
    }
};
