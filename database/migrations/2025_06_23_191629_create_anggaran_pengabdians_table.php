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
            $table->string('kode', 100);
            $table->string('kegiatan', 255);
            $table->integer('volume_usulan');
            $table->unsignedBigInteger('skema');
            $table->decimal('total_anggaran', 15, 2);
            $table->string('file')->nullable();
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
