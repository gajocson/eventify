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
        Schema::create('favorites', function (Blueprint $table) {
            // Primary Key
            $table->id('favorite_id');

            // Foreign Keys
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('business_id');

            // Foreign Key Constraints
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('business_id')->references('business_id')->on('businesses')->onDelete('cascade');

            // Optional timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};