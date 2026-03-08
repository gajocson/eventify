<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id('business_id'); // PK
            $table->string('business_name');
            $table->string('business_email')->unique();
            $table->string('business_city');
            $table->text('business_about')->nullable();
            $table->unsignedBigInteger('service_id_1')->nullable();
            $table->unsignedBigInteger('service_id_2')->nullable();
            $table->unsignedBigInteger('service_id_3')->nullable();
            $table->string('business_cont_num')->nullable();
            $table->string('password');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('service_id_1')->references('service_id')->on('services')->onDelete('set null');
            $table->foreign('service_id_2')->references('service_id')->on('services')->onDelete('set null');
            $table->foreign('service_id_3')->references('service_id')->on('services')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};