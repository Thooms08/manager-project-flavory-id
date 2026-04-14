<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('jadwal_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('member_shifts')->cascadeOnDelete();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_libur')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->time('absen_awal')->nullable();
            $table->time('absen_akhir')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('jadwal_shifts');
    }
};