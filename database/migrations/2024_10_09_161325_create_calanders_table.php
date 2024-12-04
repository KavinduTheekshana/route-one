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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
