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
        Schema::table('absensi_karyawans', function (Blueprint $table) {
            // Menambahkan kolom foto (nullable jika ada data lama yang tidak punya foto)
            $table->string('foto')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi_karyawans', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};