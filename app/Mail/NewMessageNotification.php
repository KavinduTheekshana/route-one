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

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $sender)
    {
        $this->messageContent = $messageContent;
        $this->sender = $sender; // Store sender object
    }

    public function build()
    {
        return $this->subject('New Message') // Set the email subject
                    ->view('emails.new_message'); // Set the view for the email
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'New Message Notification',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
