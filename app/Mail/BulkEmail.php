<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $htmlContent;

      public function __construct($subject, $htmlContent)
    {
        $this->subject = $subject;
        $this->htmlContent = $htmlContent;
    }

    public function build()
    {
        // return $this->subject($this->subject)
        //     ->view('emails.bulk_email')
        //     ->with('body', $this->body);

             return $this->subject($this->subject)
                ->view('emails.bulk_email')
                ->with(['htmlContent' => $this->htmlContent]);
    }
}
