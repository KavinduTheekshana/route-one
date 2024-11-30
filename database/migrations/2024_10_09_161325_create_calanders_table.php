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
        Schema::create('calanders', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title for the appointment
            $table->text('description')->nullable(); // Optional description
            $table->dateTime('start'); // Start date and time
            $table->dateTime('end'); // End date and time
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calanders');
    }
};
