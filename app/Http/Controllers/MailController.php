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

        foreach ($emails as $user) {
            // Replace {name} with the user's name in the email body
            $emailBody = str_replace('{name}', $user['name'], $body);

            // Send the email
            Mail::to($user['email'])->send(new BulkEmail($subject, $emailBody));
        }

        return response()->json(['message' => 'Emails sent successfully']);
    }
}
