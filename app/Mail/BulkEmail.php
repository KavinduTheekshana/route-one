<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $htmlContent;
    public $emailAttachments;
    public $emailLogos;

    public function __construct($subject, $htmlContent, $attachments = [], $logos = [])
    {
        $this->subject = $subject;
        $this->htmlContent = $htmlContent;
        $this->emailAttachments = $attachments;
        $this->emailLogos = $logos;
    }

    public function build()
    {
        // Debug logging
        Log::info('BulkEmail build - Original content:', ['content' => $this->htmlContent]);
        Log::info('BulkEmail build - Logos:', ['logos' => $this->emailLogos]);
        
        // Check if content is a complete HTML document
        $isCompleteHtml = $this->isCompleteHtmlDocument($this->htmlContent);
        
        $email = $this->subject($this->subject);
        
        if ($isCompleteHtml) {
            // For complete HTML documents, use raw template and ensure proper content type
            $email->view('emails.raw_html_email')
                ->with([
                    'htmlContent' => $this->htmlContent,
                    'emailLogos' => $this->emailLogos
                ]);
        } else {
            // Use the wrapped template for partial HTML content
            $email->view('emails.bulk_email')
                ->with([
                    'htmlContent' => $this->htmlContent,
                    'emailLogos' => $this->emailLogos
                ]);
        }

        // Add attachments if any
        foreach ($this->emailAttachments as $attachment) {
            $email->attach(storage_path('app/public/' . $attachment['path']), [
                'as' => $attachment['original_name'],
                'mime' => $attachment['mime_type']
            ]);
        }

        return $email;
    }
    
    /**
     * Check if the content is a complete HTML document
     */
    private function isCompleteHtmlDocument($content)
    {
        $content = trim($content);
        return (
            stripos($content, '<!doctype') === 0 || 
            stripos($content, '<!DOCTYPE') === 0 || 
            (stripos($content, '<html') !== false && stripos($content, '</html>') !== false)
        );
    }

    /**
     * Alternative method using the newer attachments() method (Laravel 9+)
     */
    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->emailAttachments as $attachment) {
            $attachments[] = Attachment::fromPath(storage_path('app/public/' . $attachment['path']))
                ->as($attachment['original_name'])
                ->withMime($attachment['mime_type']);
        }

        return $attachments;
    }
}