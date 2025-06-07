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
      Schema::create('payments', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('order_id');
        $table->decimal('amount', 10, 2);
        $table->enum('payment_status', ['pending','completed','failed'])->default('pending');
        $table->string('payment_method');
        $table->timestamp('payment_date');
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
