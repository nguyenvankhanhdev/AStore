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
            $table->integer('quantity')->nullable()->after('some_column'); // Thêm cột sau một cột nào đó, thay 'some_column' với tên cột
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variant_colors', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
