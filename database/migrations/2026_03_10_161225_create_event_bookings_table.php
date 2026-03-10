<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();

            // Customer who made the booking
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                  ->references('customer_id')
                  ->on('customers')
                  ->onDelete('set null');

            // Booking detail fields
            $table->string('package_name');
            $table->json('services');          // main service labels
            $table->json('sub_services');      // [{label, price}, ...]
            $table->integer('guest_count');
            $table->date('event_date');
            $table->decimal('total_price', 10, 2);
            $table->string('payment_method');

            // Admin management fields
            $table->string('status')->default('pending'); // pending | confirmed | cancelled
            $table->text('admin_message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_bookings');
    }
};
