<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $certificate;
    public $pdf;

    public function __construct($certificate, $pdf)
    {
        $this->certificate = $certificate;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->view('emails.certificate')
            ->subject('Your Certificate from Route One Recruitment Services Ltd')
            ->attachData($this->pdf, 'certificate.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
