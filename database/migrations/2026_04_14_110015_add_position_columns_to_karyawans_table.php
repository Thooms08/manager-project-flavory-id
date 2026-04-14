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
        Schema::table('karyawans', function (Blueprint $table) {
            // Menambahkan kolom jabatan setelah kolom nama (atau kolom lain yang ada)
            $table->string('jabatan')->nullable()->after('nama');
            
            // Menambahkan kolom jenis_karyawan (misal: Tetap, Kontrak, Part-time)
            $table->string('jenis_karyawan')->nullable()->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn(['jabatan', 'jenis_karyawan']);
        });
    }
};