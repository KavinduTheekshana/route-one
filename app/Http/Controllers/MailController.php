<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function index()
    {
        return view('backend.mail.index');
    }

    public function sendBulkEmails(Request $request)
    {
        // Validate the request
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
            'emails' => 'required|array',
            'emails.*.name' => 'sometimes|string',
            'emails.*.email' => 'required|email',
            'attachments.*' => 'nullable|file|max:10240', // Max 10MB per file
        ]);

        $subject = $request->subject;
        $body = $request->body;
        $emailsList = $request->emails;
        $attachments = [];

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bulk_mail_attachments', $filename, 'public');
                
                $attachments[] = [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType()
                ];
            }
        }

        $failedEmails = [];
        $successCount = 0;

        foreach ($emailsList as $recipient) {
            try {
                // Replace {name} placeholder with recipient's name
                $personalizedBody = str_replace('{name}', $recipient['name'] ?? '', $body);

                // Send the email with attachments
                Mail::to($recipient['email'])
                    ->send(new BulkEmail($subject, $personalizedBody, $attachments));

                $successCount++;

                // Optional: Add a small delay to prevent overwhelming the mail server
                usleep(100000); // 100ms delay

            } catch (\Exception $e) {
                Log::error('Failed to send email to: ' . $recipient['email'] . ' Error: ' . $e->getMessage());
                $failedEmails[] = $recipient['email'];
            }
        }

        // Clean up temporary files after sending
        foreach ($attachments as $attachment) {
            Storage::disk('public')->delete($attachment['path']);
        }

        return response()->json([
            'success' => true,
            'message' => "Emails sent successfully. Success: {$successCount}, Failed: " . count($failedEmails),
            'success_count' => $successCount,
            'failed_count' => count($failedEmails),
            'failed_emails' => $failedEmails
        ]);
    }
}