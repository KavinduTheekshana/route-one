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
            $table->string('family_name');
            $table->string('given_name');
            $table->string('Other_names')->default('N/A');
            $table->string('nationality');
            $table->string('place_of_birth');
            $table->string('country_of_birth');
            $table->date('dob')->nullable();
            $table->string('gender');
            $table->string('country_of_residence');
            // Passport or travel document
            $table->string('passport');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('place_of_issue');
            // Current home address
            $table->string('address');
            $table->string('city');
            $table->string('postcode')->nullable();
            $table->string('country');
            // Work dates
            $table->date('start_date');
            $table->date('end_date');
            $table->string('hours_of_work');
            // Migrant's employment
            $table->string('job_title');
            $table->string('job_type');
            $table->text('description');
            $table->decimal('salary', 10, 2);
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
