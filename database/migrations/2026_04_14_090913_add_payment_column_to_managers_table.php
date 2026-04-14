<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('managers', function (Blueprint $table) {
            $table->string('invoice_number')->nullable()->after('status');
            $table->text('payment_url')->nullable()->after('invoice_number');
            $table->string('payment_status')->default('pending')->after('payment_url');
        });
    }

    public function down(): void
    {
        Schema::table('managers', function (Blueprint $table) {
            $table->dropColumn(['invoice_number', 'payment_url', 'payment_status']);
        });
    }
};