<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_messages', function (Blueprint $table) {
            $table->id();

            // Which booking this message belongs to
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')
                  ->references('id')
                  ->on('event_bookings')
                  ->onDelete('cascade');

            // Who sent the message: 'admin' or 'customer'
            $table->string('sender_type'); // 'admin' | 'customer'
            $table->unsignedBigInteger('sender_id')->nullable(); // customer_id for customer, null for admin

            $table->text('message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_messages');
    }
};
