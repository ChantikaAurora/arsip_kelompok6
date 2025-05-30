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
            $table->id(); // ID auto increment
            $table->string('no')->nullable(); // Nomor urut otomatis, tidak perlu unik
            $table->string('nomor_surat'); // Diinput manual oleh user
            $table->date('tanggal_surat');
            $table->string('tujuan_surat');
            $table->string('perihal');
            $table->string('pengirim');
            $table->string('penerima');
            $table->foreignId('jenis') // foreign key ke jenis_arsips
                    ->constrained('jenis_arsips')
                    ->onDelete('cascade'); //foreign key dari jenis arsip wait yaa ini belum di foreign key
            $table->string('file')->nullable(); // Menyimpan path file
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
