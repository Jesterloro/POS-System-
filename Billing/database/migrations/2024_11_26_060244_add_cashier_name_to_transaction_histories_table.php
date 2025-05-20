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
            $table->string('cashier_name')->nullable();  // Add the cashier_name column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->dropColumn('cashier_name');  // Drop the cashier_name column if rolled back
        });
    }
};
