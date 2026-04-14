<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relasis', function (Blueprint $table) {
            $table->id();
            // Asumsi nama tabel karyawan adalah 'karyawans'
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->string('manager_key');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relasis');
    }
};