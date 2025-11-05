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
        Schema::create('bulk_mail_logs', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id'); // Group emails from same bulk send
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('subject');
            $table->longText('body');
            $table->string('status'); // 'sent', 'failed'
            $table->text('error_message')->nullable();
            $table->unsignedBigInteger('sent_by'); // User who sent the email
            $table->timestamps();

            $table->index('batch_id');
            $table->index('status');
            $table->foreign('sent_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_mail_logs');
    }
};
