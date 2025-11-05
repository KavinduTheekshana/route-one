<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use App\Models\BulkMailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'logos.*.file' => 'nullable|image|max:5120', // Max 5MB per image
            'logos.*.cid' => 'sometimes|string',
            'logos.*.name' => 'sometimes|string',
        ]);

        $subject = $request->subject;
        $body = $request->body;
        $emailsList = $request->emails;
        $attachments = [];
        $logos = [];

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

        // Handle logo uploads
        if ($request->has('logos')) {
            Log::info('Processing logos:', ['logos_input' => $request->input('logos', [])]);
            foreach ($request->input('logos', []) as $index => $logoData) {
                Log::info('Processing logo index:', ['index' => $index, 'logoData' => $logoData]);
                if ($request->hasFile("logos.{$index}.file")) {
                    $file = $request->file("logos.{$index}.file");
                    $cid = $logoData['cid'] ?? 'logo_' . time() . '_' . $index;
                    $filename = $cid . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('bulk_mail_logos', $filename, 'public');
                    
                    $logos[] = [
                        'cid' => $cid,
                        'path' => $path,
                        'original_name' => $logoData['name'] ?? $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType()
                    ];
                    Log::info('Logo processed:', ['cid' => $cid, 'path' => $path, 'filename' => $filename]);
                }
            }
        }
        
        Log::info('Final logos array:', ['logos' => $logos]);
        Log::info('Request body content:', ['body' => $body]);

        // Generate a unique batch ID for this bulk send
        $batchId = Str::uuid();

        $failedEmails = [];
        $successCount = 0;

        foreach ($emailsList as $recipient) {
            try {
                // Replace {name} placeholder with recipient's name
                $personalizedBody = str_replace('{name}', $recipient['name'] ?? '', $body);

                // Send the email with attachments and logos
                Mail::to($recipient['email'])
                    ->send(new BulkEmail($subject, $personalizedBody, $attachments, $logos));

                // Log successful email
                BulkMailLog::create([
                    'batch_id' => $batchId,
                    'recipient_name' => $recipient['name'] ?? '',
                    'recipient_email' => $recipient['email'],
                    'subject' => $subject,
                    'body' => $personalizedBody,
                    'status' => 'sent',
                    'sent_by' => Auth::id()
                ]);

                $successCount++;

                // Optional: Add a small delay to prevent overwhelming the mail server
                usleep(100000); // 100ms delay

            } catch (\Exception $e) {
                Log::error('Failed to send email to: ' . $recipient['email'] . ' Error: ' . $e->getMessage());
                $failedEmails[] = $recipient['email'];

                // Log failed email
                BulkMailLog::create([
                    'batch_id' => $batchId,
                    'recipient_name' => $recipient['name'] ?? '',
                    'recipient_email' => $recipient['email'],
                    'subject' => $subject,
                    'body' => $personalizedBody,
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'sent_by' => Auth::id()
                ]);
            }
        }

        // Clean up temporary files after sending
        foreach ($attachments as $attachment) {
            Storage::disk('public')->delete($attachment['path']);
        }
        
        foreach ($logos as $logo) {
            Storage::disk('public')->delete($logo['path']);
        }

        return response()->json([
            'success' => true,
            'message' => "Emails sent successfully. Success: {$successCount}, Failed: " . count($failedEmails),
            'success_count' => $successCount,
            'failed_count' => count($failedEmails),
            'failed_emails' => $failedEmails,
            'batch_id' => $batchId
        ]);
    }

    public function downloadReport($batchId = null)
    {
        // If no batch ID provided, get all logs for the current user
        $query = BulkMailLog::query();

        if ($batchId) {
            $query->where('batch_id', $batchId);
        } else {
            // Get logs from the current user
            $query->where('sent_by', Auth::id());
        }

        $logs = $query->orderBy('created_at', 'desc')->get();

        if ($logs->isEmpty()) {
            return redirect()->back()->with('error', 'No email logs found.');
        }

        $filename = 'bulk_email_report_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'Batch ID',
                'Recipient Name',
                'Recipient Email',
                'Subject',
                'Status',
                'Error Message',
                'Sent Date/Time',
                'Sent By'
            ]);

            // Add data rows
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->batch_id,
                    $log->recipient_name,
                    $log->recipient_email,
                    $log->subject,
                    ucfirst($log->status),
                    $log->error_message ?? 'N/A',
                    $log->created_at->format('Y-m-d H:i:s'),
                    $log->sender->name ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function sendSingleEmail(Request $request)
    {
        // Validate the request
        $request->validate([
            'batch_id' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
            'name' => 'sometimes|string',
            'email' => 'required|email',
            'attachments' => 'sometimes|array',
            'logos' => 'sometimes|array',
        ]);

        $batchId = $request->batch_id;
        $subject = $request->subject;
        $body = $request->body;
        $name = $request->name ?? '';
        $email = $request->email;
        $attachments = $request->attachments ?? [];
        $logos = $request->logos ?? [];

        try {
            // Replace {name} placeholder with recipient's name
            $personalizedBody = str_replace('{name}', $name, $body);

            // Send the email
            Mail::to($email)
                ->send(new BulkEmail($subject, $personalizedBody, $attachments, $logos));

            // Log successful email
            BulkMailLog::create([
                'batch_id' => $batchId,
                'recipient_name' => $name,
                'recipient_email' => $email,
                'subject' => $subject,
                'body' => $personalizedBody,
                'status' => 'sent',
                'sent_by' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'status' => 'sent',
                'message' => 'Email sent successfully',
                'email' => $email
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send email to: ' . $email . ' Error: ' . $e->getMessage());

            // Log failed email
            BulkMailLog::create([
                'batch_id' => $batchId,
                'recipient_name' => $name,
                'recipient_email' => $email,
                'subject' => $subject,
                'body' => $personalizedBody,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'sent_by' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'status' => 'failed',
                'message' => $e->getMessage(),
                'email' => $email
            ], 500);
        }
    }
}