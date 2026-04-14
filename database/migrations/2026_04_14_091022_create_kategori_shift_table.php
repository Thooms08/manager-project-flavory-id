<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kategori_shifts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('manager_id')->constrained('managers')->cascadeOnDelete();
            $table->string('shift');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('kategori_shifts');
    }
};