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
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('You Have a New Message')
                    ->view('emails.new_message')
                    ->with([
                        'messageContent' => $this->messageContent,
                        'sender' => $this->sender,
                    ])
                    ->html($this->messageContent); // Explicitly send as HTML
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
