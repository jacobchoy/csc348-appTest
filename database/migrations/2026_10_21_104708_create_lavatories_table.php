<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lavatories', function (Blueprint $table) {
            $table->id();
            $table->string('location')->index();
            $table->string('status')->default('vacant')->index();
            $table->string('gender_type')->default('unisex');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lavatories');
    }
};
