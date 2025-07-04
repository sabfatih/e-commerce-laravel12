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
        $table->uuid('id')->primary();
        $table->uuid('store_id');
        $table->string('name');
        $table->string('slug');
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->integer('stock');
        $table->decimal('weight', 8, 2)->nullable();
        $table->timestamps();

        $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
