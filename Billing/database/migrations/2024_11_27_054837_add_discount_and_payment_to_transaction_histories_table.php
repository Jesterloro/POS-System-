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
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->decimal('discount', 10, 2)->default(0)->after('tax'); // Add discount
            $table->decimal('payment_received', 10, 2)->default(0)->after('discount'); // Add payment received
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('payment_received');
        });
    }
};
