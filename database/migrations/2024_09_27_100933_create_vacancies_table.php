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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('company')->nullable();
            $table->string('title');
            $table->string('location');
            $table->string('job_type');
            $table->longText('meta_description');
            $table->longText('description')->nullable();
            $table->string('salary')->nullable();
            $table->string('tags')->nullable();
            $table->string('experience')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('urgent')->default(0);
            $table->boolean('status')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
