<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Update products with original_price set to 0
         Product::where('original_price', 0)
         ->update(['original_price' => DB::raw('price')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If needed, you can revert the update
        Product::where('original_price', '>', 0)
            ->update(['original_price' => 0]);
    }
};
