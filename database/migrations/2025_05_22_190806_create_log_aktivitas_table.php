<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id(); // no
            $table->unsignedBigInteger('id_user'); // id_user
            $table->string('aktivitas'); // aktivitas
            $table->string('aksi'); // aksi
            $table->timestamp('waktu')->default(DB::raw('CURRENT_TIMESTAMP')); // waktu
            $table->string('modul'); // modul
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
