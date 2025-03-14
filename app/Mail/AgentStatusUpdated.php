<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $statusMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $statusMessage)
    {
        $this->user = $user;
        $this->statusMessage = $statusMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Account Status Has Been Updated')
                    ->view('emails.agent_status_updated');
    }
}
