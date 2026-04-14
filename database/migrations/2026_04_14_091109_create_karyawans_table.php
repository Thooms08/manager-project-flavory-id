<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            // Asumsi tabel managers sudah ada. Jika manager gabung di users, ganti 'managers' jadi 'users'
            $table->foreignId('manager_id')->constrained('managers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_tlp');
            $table->date('tgl_lahir');
            $table->string('domisili')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pendidikan_terakhir');
            $table->date('tgl_masuk');
            
            $table->string('ktp')->nullable();
            $table->string('cv')->nullable();
            
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};