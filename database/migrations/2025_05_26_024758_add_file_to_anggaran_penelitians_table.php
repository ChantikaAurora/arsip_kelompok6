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
        Schema::table('anggaran_penelitians', function (Blueprint $table) {
            $table->string('file')->nullable(); // kolom baru
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggaran_penelitians', function (Blueprint $table) {
            $table->dropColumn('file'); // rollback
        });
    }
};
