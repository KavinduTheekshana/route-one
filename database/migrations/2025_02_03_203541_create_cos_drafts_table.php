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
        Schema::create('cos_drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->string('sponsor_license_number')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('certificate_number')->nullable();
            $table->string('status')->default('DRAFT');
            $table->date('current_certificate_status_date')->nullable();
            $table->date('date_assign')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('sponsor_note')->nullable();
            // Personal information
            $table->string('family_name')->nullable();
            $table->string('given_name')->nullable();
            $table->string('Other_names')->default('N/A');
            $table->string('nationality')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('country_of_residence')->nullable();
            // Passport or travel document
            $table->string('passport')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('place_of_issue')->nullable();
            // Current home address
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            // Work dates
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('hours_of_work')->nullable();
            $table->string('work_address')->nullable();
            $table->string('work_city')->nullable();
            $table->string('work_county')->nullable();
            $table->string('work_postcode')->nullable();

            // Migrant's employment
            $table->string('job_title')->nullable();
            $table->string('job_type')->nullable();
            $table->text('description')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('paye_reference')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cos_drafts');
    }
};
