<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('member_shifts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_shifts')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('member_shifts');
    }
};