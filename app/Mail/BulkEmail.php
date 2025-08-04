<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $htmlContent;
    public $emailAttachments;

    public function __construct($subject, $htmlContent, $attachments = [])
    {
        $this->subject = $subject;
        $this->htmlContent = $htmlContent;
        $this->emailAttachments = $attachments;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
            ->view('emails.bulk_email')
            ->with(['htmlContent' => $this->htmlContent]);

        // Add attachments if any
        foreach ($this->emailAttachments as $attachment) {
            $email->attach(storage_path('app/public/' . $attachment['path']), [
                'as' => $attachment['original_name'],
                'mime' => $attachment['mime_type']
            ]);
        }

        return $email;
    }

    /**
     * Alternative method using the newer attachments() method (Laravel 9+)
     */
    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->emailAttachments as $attachment) {
            $attachments[] = Attachment::fromPath(storage_path('app/public/' . $attachment['path']))
                ->as($attachment['original_name'])
                ->withMime($attachment['mime_type']);
        }

        return $attachments;
    }
}