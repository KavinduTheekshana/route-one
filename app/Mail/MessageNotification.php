<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $sender;
    public $attachments;

    /**
     * Create a new message instance.
     */
    public function __construct($messageContent, $sender, $attachments)
    {
        $this->messageContent = $messageContent;
        $this->sender = $sender;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $email = $this->from(config('mail.from.address'), 'Your App Name')
            ->subject('New Message Received')
            ->view('emails.message_notification')
            ->with([
                'messageContent' => $this->messageContent,
                'sender' => $this->sender,
            ]);

        // Attach uploaded files if available


        return $email;
    }

 // Add attachments from storage
 public function attachments(): array
 {
     $emailAttachments = [];

     foreach ($this->attachments as $attachment) {
         // Add attachment
        //  $emailAttachments[] = Attachment::fromStorageDisk(
        //      'public',
        //      $attachment['path']
        //  )->as($attachment['original_name']);


        $emailAttachments[Attachment::fromPath(storage_path('app/public/'.$attachment['path']))->as($attachment['original_name'])];


         // Correct logging implementation
        //  Log::info('Attaching file:', [
        //      'storage_path' => $attachment['path'],
        //      'original_name' => $attachment['original_name'],
        //      'full_storage_path' => storage_path('app/public/'.$attachment['path']),
        //      'public_parth' => public_path('storage'.$attachment['path'])
        //  ]);
     }
Log::info('HI', $emailAttachments);
     return $emailAttachments;
 }
}
