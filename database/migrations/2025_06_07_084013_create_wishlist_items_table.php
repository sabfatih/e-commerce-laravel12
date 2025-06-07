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
      Schema::create('wishlist_items', function (Blueprint $table) {
        $table->uuid('id');
        $table->uuid('wishlist_id');
        $table->uuid('product_id');
        $table->timestamps();
        $table->primary(['id','wishlist_id', 'product_id']);

        $table->foreign('wishlist_id')->references('id')->on('wishlists')->cascadeOnDelete();
        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};
