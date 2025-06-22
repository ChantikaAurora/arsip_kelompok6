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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('nomor_agenda');
            $table->string('kode_klasifikasi');
            $table->date('tanggal_surat');
            $table->string('tujuan_surat');
            $table->string('penerima');
            $table->string('perihal');
            $table->string('lampiran')->nullable();
            $table->foreignId('jenis')->constrained('jenis_arsips')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
