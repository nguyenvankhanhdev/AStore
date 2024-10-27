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
        Schema::table('variant_colors', function (Blueprint $table) {
            $table->bigInteger('warehouse_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variant_colors', function (Blueprint $table) {
            $table->decimal('warehouse_price', 15, 2)->change(); // Revert back to the original type if it was decimal or any other
        });
    }
};
