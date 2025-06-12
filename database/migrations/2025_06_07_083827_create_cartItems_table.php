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
      Schema::create('cart_items', function (Blueprint $table) {
        $table->uuid('id');
        $table->uuid('user_id');
        $table->uuid('product_id');
        $table->integer('quantity');
        $table->timestamps();
        $table->primary(['id','user_id', 'product_id']);


        $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
