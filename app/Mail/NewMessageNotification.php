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
    public $attachments; // Variable to hold attachments
    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $sender, $attachments = [])
    {
        $this->messageContent = $messageContent;
        $this->sender = $sender; // Store sender object
        $this->attachments = $attachments; // Store attachments array
    }

    public function build()
    {
        $email = $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('You Have a New Message')
                    ->view('emails.new_message')
                    ->with([
                        'messageContent' => $this->messageContent,
                        'sender' => $this->sender,
                        'attachments' => $this->attachments,
                    ]);

        // Attach each file
        foreach ($this->attachments as $attachment) {
            $email->attachFromStorageDisk('public', $attachment['path'], [
                'as' => $attachment['original_name']
            ]);
        }

        return $email;
    }
}
