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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->date('current_date');
            $table->string('applicant_name');
            $table->date('dob');
            $table->enum('result', ['pass', 'fail']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for users
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade'); // Foreign key for applications
            $table->foreignId('job_id')->constrained('vacancies')->onDelete('cascade'); // Foreign key for applications
            $table->date('assessment_date');
            $table->string('confirmation_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
