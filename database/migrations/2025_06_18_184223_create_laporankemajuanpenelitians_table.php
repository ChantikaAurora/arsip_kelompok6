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
        Schema::create('laporankemajuanpenelitians', function (Blueprint $table) {
            $table->uuid('id_laporan')->primary(); // gunakan UUID sebagai primary key
            $table->string('judul_kegiatan');
            $table->string('nama_ketua');
            $table->string('nama_anggota');
            $table->foreignId('skema')->constrained('skema_penelitians')->onDelete('cascade');
            $table->string('tahun_pelaksanaan', 4); // year atau varchar(4)
            $table->foreignId('jurusan')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('prodi')->constrained('prodis')->onDelete('cascade');
            $table->enum('periode_laporan', ['Semester 1', 'Semester 2', ' Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8']);
            $table->text('ringkasan');
            $table->string('file');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporankemajuanpenelitians');
    }
};
