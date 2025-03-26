<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent; // Variable to hold the message content
    public $sender; // Variable to hold the sender information
    public $attachments;

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $sender, $attachments = [])
    {
        $this->messageContent = $messageContent;
        $this->sender = $sender; // Store sender object
    }

    public function build()
    {
        return $this->subject('New Message from ' . $this->sender->name)
                    ->view('emails.new_message')
                    ->with([
                        'messagecontent' => $this->messageContent,
                        'sender' => $this->sender,
                        'attachments' => $this->attachments,
                    ]);
    }
}
