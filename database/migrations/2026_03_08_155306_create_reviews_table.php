<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');

            $table->unsignedBigInteger('customer_id'); // must match customers.customer_id type
            $table->unsignedBigInteger('package_id')->nullable(); // optional if reviews are for packages
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('customer_id')
                  ->references('customer_id')   // match your customers table pk
                  ->on('customers')
                  ->onDelete('cascade');

            if (Schema::hasTable('packages')) {
                $table->foreign('package_id')
                      ->references('pkg_id') // match your packages table pk
                      ->on('packages')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};