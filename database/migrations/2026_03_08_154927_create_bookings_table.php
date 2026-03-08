<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');

            $table->unsignedBigInteger('package_id')->nullable(); // must match packages.pkg_id type
            $table->unsignedBigInteger('customer_id')->nullable(); // example: link to customers table
            $table->date('booking_date');
            $table->timestamps();

            // Foreign keys
            $table->foreign('package_id')
                  ->references('pkg_id')   // THIS must match the actual pk in packages
                  ->on('packages')
                  ->onDelete('set null');

            $table->foreign('customer_id')
                  ->references('customer_id') // adjust if different
                  ->on('customers')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};