<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('variant_colors', function (Blueprint $table) {
            $table->integer('quantity')->nullable(); // Thêm cột quantity kiểu integer có thể null
        });
    }

    public function down()
    {
        Schema::table('variant_colors', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Xóa cột quantity khi rollback
        });
    }
};
