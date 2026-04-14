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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel user (pastikan menggunakan tabel 'user' sesuai catatan Anda)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->uuid('uuid')->unique();
            $table->string('manager_key')->unique()->nullable(); // Kunci unik untuk identifikasi manager
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_whatsapp', 20);
            $table->string('jenis_bisnis');
            
            // Menggunakan enum untuk konsistensi data status
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};