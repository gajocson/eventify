<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id('business_id');
            $table->string('business_name');
            $table->string('business_email')->unique();

            // Foreign keys must match services.id type
            $table->unsignedBigInteger('service_id_1')->nullable();
            $table->unsignedBigInteger('service_id_2')->nullable();
            $table->unsignedBigInteger('service_id_3')->nullable();

            $table->string('business_cont_num')->nullable();
            $table->string('password');
            $table->timestamps();

            // Explicit foreign keys
            $table->foreign('service_id_1')->references('id')->on('services')->nullOnDelete();
            $table->foreign('service_id_2')->references('id')->on('services')->nullOnDelete();
            $table->foreign('service_id_3')->references('id')->on('services')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};