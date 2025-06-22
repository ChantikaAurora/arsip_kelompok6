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
        Schema::create('suratmasuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('kode_klasifikasi');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->string('asal_surat');
            $table->string('pengirim');
            $table->string('perihal');
            $table->string('lampiran')->nullable();
            $table->foreignId('jenis'); // asumsikan relasi ke tabel jenis
            $table->text('keterangan')->nullable();
            $table->string('file');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratmasuks');
    }
};
