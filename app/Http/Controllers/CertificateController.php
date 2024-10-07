<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Certificate;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Vacancies;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\CertificateMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{


    public function sendCertificateEmail(Request $request)
    {
        // Find the certificate using the $id
        $id = $request->input('certificate_id');
        $certificate = Certificate::findOrFail($id);

        // Fetch the email from the form input
        $email = $request->input('email');

        // Generate the PDF using DomPDF
        $pdf = Pdf::loadView('certificates.certificate', compact('certificate'));

        // Send the PDF as an email attachment
        // Mail::send([], [], function ($message) use ($email, $pdf, $certificate) {
        //     $message->to($email)
        //         ->subject('Route One | English Language Proficiency Interview result')
        //         ->attachData($pdf->output(), "certificate.pdf", [
        //             'mime' => 'application/pdf',
        //         ]);
        // });
        Mail::send('emails.certificate', ['certificate' => $certificate], function ($message) use ($email, $pdf, $certificate) {
            $message->to($email)
                ->subject('Route One | English Language Proficiency Interview Result')
                ->attachData($pdf->output(), "Certificate($certificate->confirmation_code).pdf", [
                    'mime' => 'application/pdf',
                ]);
        });


        // Redirect back or return a success message
        return back()->with('success', 'Certificate emailed successfully.');
    }


    public function issueCertificate($id)
    {
        // Find the application by ID
        $application = Application::where('id', $id)->first();

        // Check if a certificate already exists for this application
        $certificate = Certificate::where('application_id', $application->id)->first();

        // Get the list of jobs for the user
        $jobs = JobApplication::where('user_id', $application->user_id)
            ->with('job') // Assuming you have a relationship defined for Job in JobApplication model
            ->get();

        $vacancies = null;
        if ($certificate) {
            $vacancies = Vacancies::where('id', $certificate->job_id)->first();
        }

        // dd($vacancies);

        // dd($vacancies);
        // Get the current date
        $currentDate = Carbon::now()->format('Y-m-d');

        // Pass the certificate (if any) to the view along with other data
        return view('backend.applications.certificate', compact('jobs', 'application', 'currentDate', 'certificate', 'vacancies'));
    }



    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'current_date' => 'required|date',
            'applicant_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'result' => 'required|in:pass,fail',
            'user_id' => 'required',
            'application_id' => 'required',
            'job_id' => 'required|exists:vacancies,id', // Assuming you have a jobs table
            'assessment_date' => 'required|date',
            'confirmation_code' => 'required|string|max:10',
        ]);

        // Create a new certificate entry
        $certificate = Certificate::create([
            'current_date' => $request->input('current_date'),
            'applicant_name' => $request->input('applicant_name'),
            'dob' => $request->input('dob'),
            'result' => $request->input('result'),
            'user_id' => $request->input('user_id'),
            'application_id' => $request->input('application_id'),
            'job_id' => $request->input('job_id'),
            'assessment_date' => $request->input('assessment_date'),
            'confirmation_code' => $request->input('confirmation_code'),
        ]);

        // Redirect back to the form with the saved certificate data
        return redirect()->route('certificate.issue', $request->application_id)
            ->with('certificate', $certificate)
            ->with('success', 'Certificate saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'current_date' => 'required|date',
            'applicant_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'result' => 'required|in:pass,fail',
            'user_id' => 'required',
            'application_id' => 'required',
            'job_id' => 'required|exists:vacancies,id', // Adjust according to your jobs table
            'assessment_date' => 'required|date',
            'confirmation_code' => 'required|string|max:10',
        ]);

        // Find the existing certificate
        $certificate = Certificate::findOrFail($id);

        // Update the certificate entry
        $certificate->update([
            'current_date' => $request->input('current_date'),
            'applicant_name' => $request->input('applicant_name'),
            'dob' => $request->input('dob'),
            'result' => $request->input('result'),
            'user_id' => $request->input('user_id'),
            'application_id' => $request->input('application_id'),
            'job_id' => $request->input('job_id'),
            'assessment_date' => $request->input('assessment_date'),
            'confirmation_code' => $request->input('confirmation_code'),
        ]);

        // Redirect back to the form with the updated certificate data
        return redirect()->route('certificate.issue', $request->application_id)
            ->with('certificate', $certificate)
            ->with('success', 'Certificate updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
