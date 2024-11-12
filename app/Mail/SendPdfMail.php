<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $subjectLine;
    public $message;

    public function __construct($pdf,$subjectLine,$emailMessage)
    {
        $this->pdf = $pdf;
        $this->subjectLine = $subjectLine;
        $this->message = $emailMessage;
    }

    public function build()
    {
        // Generate a filename with the current date and time
        $fileName = 'invoice_' . Carbon::now()->format('Y-m-d_His') . '.pdf';

        return $this->view('emails.invoice') // Specify your email view
            ->subject($this->subjectLine)
            ->with('emailMessage', $this->message)
            ->attachData(base64_decode($this->pdf), $fileName, [
                'mime' => 'application/pdf',
            ]);
    }
}