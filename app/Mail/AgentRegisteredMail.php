<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;

    /**
     * Create a new message instance.
     *
     * @param $agent
     */
    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Our Platform!')
            ->view('emails.agent_registered')
            ->with(['agent' => $this->agent]);
    }
}
