<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('backend.mail.index');
    }

    // public function sendBulkEmails(Request $request)
    // {
    //     $subject = $request->input('subject');
    //     $body = $request->input('body');
    //     $emails = $request->input('emails'); // Array of emails and names

    //     $failedEmails = []; // To track emails that failed

    //     foreach ($emails as $user) {
    //         try {
    //             // Replace {name} with the user's name in the email body
    //             $emailBody = str_replace('{name}', $user['name'], $body);

    //             // Send the email
    //             Mail::to($user['email'])->send(new BulkEmail($subject, $emailBody));
    //         } catch (\Exception $e) {
    //             // Log the error or track the failed email
    //             $failedEmails[] = $user['email'];
    //         }
    //     }

    //     $responseMessage = [
    //         'message' => 'Emails sent with some failures',
    //         'failed_emails' => $failedEmails
    //     ];

    //     // Return the result, including any failed emails
    //     return response()->json($responseMessage);
    // }

    public function sendBulkEmails(Request $request)
    {
        // Validate the request
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
            'emails' => 'required|array',
            'emails.*.name' => 'sometimes|string',
            'emails.*.email' => 'required|email',
        ]);

        $subject = $request->subject;
        $body = $request->body;
        $emailsList = $request->emails;

        $failedEmails = [];

        foreach ($emailsList as $recipient) {
            try {
                // Replace {name} placeholder with recipient's name
                $personalizedBody = str_replace('{name}', $recipient['name'] ?? '', $body);

                // Send the email
                Mail::to($recipient['email'])
                    ->send(new BulkEmail($subject, $personalizedBody));

            

                // Optional: Add a small delay to prevent overwhelming the mail server
                usleep(100000); // 100ms delay

            } catch (\Exception $e) {
                Log::error('Failed to send email to: ' . $recipient['email'] . ' Error: ' . $e->getMessage());
                $failedEmails[] = $recipient['email'];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Emails sent successfully',
            'failed_emails' => $failedEmails
        ]);
    }
}
