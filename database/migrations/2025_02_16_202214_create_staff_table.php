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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Add this line
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
