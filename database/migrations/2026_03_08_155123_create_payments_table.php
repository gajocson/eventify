<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('transaction_id'); // PK
            $table->unsignedBigInteger('booking_id'); // FK
            $table->string('payment_status');
            $table->date('payment_date');
            $table->timestamps();

            $table->foreign('booking_id')
                  ->references('booking_id')
                  ->on('bookings')
                  ->onDelete('cascade'); // adjust as needed
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};