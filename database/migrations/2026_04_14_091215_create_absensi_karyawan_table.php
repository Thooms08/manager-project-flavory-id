<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensi_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->constrained('managers')->cascadeOnDelete();
            $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();
            $table->foreignId('jadwal_id')->constrained('jadwal_shifts')->cascadeOnDelete();
            $table->enum('status', ['absen', 'mangkir', 'izin', 'libur']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_karyawans');
    }
};