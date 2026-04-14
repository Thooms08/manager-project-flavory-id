<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasi_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->constrained('managers')->cascadeOnDelete();
            $table->string('kode_verifikasi', 6);
            $table->dateTime('expired_at');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_managers');
    }
};