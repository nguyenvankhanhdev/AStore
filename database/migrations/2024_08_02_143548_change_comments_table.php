<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Psy\Shell;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->Integer('cmt_id');
            $table->integer('status');
        });
    }


    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('cmt_id');
            $table->dropColumn('status');
        });
    }
};
