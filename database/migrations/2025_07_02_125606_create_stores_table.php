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
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ["Power Merchant Pro", "Official Store", "Power Merchant"])->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->primary(['id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
