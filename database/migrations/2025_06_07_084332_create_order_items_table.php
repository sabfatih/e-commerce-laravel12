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
      Schema::create('order_items', function (Blueprint $table) {
        $table->uuid('id');
        $table->uuid('order_id');
        $table->uuid('product_id');
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->timestamps();
        $table->primary(['id','order_id', 'product_id']);

        $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
