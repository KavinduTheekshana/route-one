<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('backend.mail.index');
    }

    public function sendBulkEmails(Request $request)
    {
        $subject = $request->input('subject');
        $body = $request->input('body');
        $emails = $request->input('emails'); // Array of emails and names

        $failedEmails = []; // To track emails that failed

        foreach ($emails as $user) {
            try {
                // Replace {name} with the user's name in the email body
                $emailBody = str_replace('{name}', $user['name'], $body);

                // Send the email
                Mail::to($user['email'])->send(new BulkEmail($subject, $emailBody));
            } catch (\Exception $e) {
                // Log the error or track the failed email
                $failedEmails[] = $user['email'];
            }
        }

        $responseMessage = [
            'message' => 'Emails sent with some failures',
            'failed_emails' => $failedEmails
        ];

        // Return the result, including any failed emails
        return response()->json($responseMessage);
    }
}
