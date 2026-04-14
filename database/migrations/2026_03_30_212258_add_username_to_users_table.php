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
    Schema::table('users', function (Blueprint $table) {
        // Tambahkan kolom username, buat unik, dan letakkan setelah ID
        $table->string('username')->unique()->after('id');
        
        // Opsional: Jika kamu tidak pakai email untuk login, 
        // kamu bisa buat kolom email menjadi nullable atau hapus saja.
        $table->string('email')->nullable()->change(); 
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('username');
    });
}
    /**
     * Reverse the migrations.
     */
};
