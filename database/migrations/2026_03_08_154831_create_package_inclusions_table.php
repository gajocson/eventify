<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_inclusions', function (Blueprint $table) {
            $table->id('inclusion_id');
            
            $table->unsignedBigInteger('package_id'); // FK to packages.pkg_id
            $table->string('item_name'); // example inclusion column
            $table->timestamps();

            // Foreign key
            $table->foreign('package_id')
                  ->references('pkg_id')
                  ->on('packages')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_inclusions');
    }
};