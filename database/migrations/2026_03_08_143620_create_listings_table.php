<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id('listing_id');       // PK
            $table->unsignedBigInteger('business_id'); // FK
            $table->string('name');         // Listing name
            $table->string('listing_pic')->nullable(); // Listing picture
            $table->timestamps();           // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};