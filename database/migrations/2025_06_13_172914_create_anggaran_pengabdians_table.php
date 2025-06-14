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
        Schema::create('anggaran_pengabdians', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('kegiatan');
            $table->integer('volume');
            $table->string('skema');
            $table->string('total_anggaran');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_pengabdians');
    }
};
