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
      Schema::create('category_product', function (Blueprint $table) {
        $table->uuid('category_id');
        $table->uuid('product_id');
        $table->primary(['category_id', 'product_id']);

        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
