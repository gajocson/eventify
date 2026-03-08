<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id('pkg_id'); // primary key
            $table->unsignedBigInteger('pi_id'); // FK to pricing.pi_id

            // Foreign key constraint
            $table->foreign('pi_id')
                  ->references('pi_id')
                  ->on('pricing')
                  ->onDelete('cascade');

            $table->string('package_name'); // example column
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};