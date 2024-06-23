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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('image');
            $table->integer('quantity');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->float('price');
            $table->boolean('status');
            $table->string('product_type')->nullable();
            $table->float('offer_price')->nullable();
            $table->dateTime('offer_start_date')->nullable();
            $table->dateTime('offer_end_date')->nullable();
            $table->integer('sub_cate_id');
            $table->integer('cate_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
