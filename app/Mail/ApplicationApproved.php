<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    /**
     * Create a new message instance.
     */
    public function __construct($applicantName)
    {
        $this->applicantName = $applicantName;
    }

    public function build()
    {
        return $this->subject('Congratulations! Your Application Has Been Approved')
                    ->view('emails.application_approved');
    }
}
