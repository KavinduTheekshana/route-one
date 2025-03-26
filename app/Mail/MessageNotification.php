<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $sender;
    public $attachments;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $sender, $attachments)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->attachments = $attachments;
    }


    /**
     * Get the message envelope.
     */
    public function build()
    {
        $email = $this->from('your-email@example.com', 'Your App Name')
            ->subject('New Message Received')
            ->view('emails.message_notification')
            ->with([
                'message' => $this->message,
                'sender' => $this->sender,
            ]);

        // Attach uploaded files if available
        foreach ($this->attachments as $attachment) {
            $email->attach(storage_path('app/public/' . $attachment['path']), [
                'as' => $attachment['original_name']
            ]);
        }

        return $email;
    }
}
