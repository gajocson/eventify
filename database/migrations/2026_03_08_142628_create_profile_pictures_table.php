<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_pictures', function (Blueprint $table) {
            $table->id('profile_picture_id'); // PK
            $table->unsignedBigInteger('business_id'); // FK
            $table->string('picture_path'); // file path or URL
            $table->timestamps();

            // Foreign key
            $table->foreign('business_id')
                  ->references('business_id')
                  ->on('businesses') // table name matches the first migration
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_pictures');
    }
};