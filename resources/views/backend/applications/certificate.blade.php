@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">

    <style>
        a:hover {
            text-decoration: none !important;
        }

        p {
            margin: 0 !important;
            ;
        }

        .light-text {
            font-weight: 300;
            color: rgb(255, 0, 0) !important;
        }

        .mt-4 {
            margin-top: 20px !important;
        }

        .mt-2 {
            margin-top: 10px !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Certificate Management')
    @include('backend.components.breadcrumb')

</div>


@include('backend.components.alert')

<div class="row">
    <div class="card overflow-hidden p-16 col-7 m-12">
        {{-- <h4 class="mb-0 ml-4"><b>Routeone English Certificate</b></h4> --}}
        <div class="card-body p-16">

            <div class="certificate">
                <img src="{{ asset('backend/images/logo/routeone_logo.svg') }}" style="width: 250px" alt="">
                <h5 style="margin-top: 30px"><b>Route One Recruitment Services Ltd
                        <br>English Language Proficiency Interview Result</b></h5>

                <br>
                <p>Date of Issue: <span class="light-text"
                        id="current-date">{{ $certificate->current_date ?? $currentDate }}</span></p>
                <p>Validity Period: <span class="light-text">1 Year</span></p>
                <p>Applicant Name: <span class="light-text"
                        id="applicant-name">{{ $certificate->applicant_name ?? '' }}</span></p>
                <p>Date of Birth: <span class="light-text" id="dob-output">{{ $certificate->dob ?? '' }}</span></p>
                <p>Job Applied For: <span class="light-text" id="applied-job">{{ $vacancies->title ?? '' }}</span></p>
                <p>Assessment Date: <span class="light-text"
                        id="assesment-date">{{ $certificate->assessment_date ?? '' }}</span></p>
                <br>
                <p>Dear <span class="light-text"
                        id="applicant-name-output">{{ $certificate->applicant_name ?? '' }}</span>,</p>
                <div id="content">
                    @if ($certificate)
                        @if ($certificate->result === 'pass')
                            <p class="success-message">
                            <p>We are pleased to inform you that you have successfully passed the English Language
                                Proficiency
                                Interview conducted by our team. Your English language skills meet the required standard
                                for your applied
                                job position at Route One Recruitment Services Ltd.</p>
                            <br>
                            <p>As a result, your application has automatically escalated to the next stage of the
                                recruitment
                                process. No further action is required regarding your English proficiency, and we will
                                be in contact with
                                the next steps soon.</p>
                            <br>
                            </p>
                        @elseif($certificate->result === 'fail')
                            <p class="failure-message">
                            <p>After reviewing your English Language Proficiency Interview, we regret to inform you that
                                you did not meet the required standard for your applied job position at Route One
                                Recruitment Services Ltd.</p>
                            <br>
                            <p>As a result, we are offering you the opportunity to enroll in our English Language Course
                                to help improve your language skills and successfully re-qualify. You can choose from
                                one of the following course durations:</p>
                            <ul>
                                <li>3-month course</li>
                                <li>6-month course</li>
                            </ul>
                            <p>Upon successful completion of the course, you will have the chance to reapply for the
                                interview.</p>
                            <br>
                            <p><b>Action Required: </b>Please contact us within 7 days to confirm your preferred course
                                option and next steps.</p>
                            <br>
                            </p>
                        @endif
                    @else
                        <p>No results available yet.</p>
                    @endif
                </div>
                <p>Confirmation Code: <span class="light-text"
                        id="confirmation-code-output">{{ $certificate->confirmation_code ?? '' }}</span></p>
                <br>
                <p>For any further inquiries, please contact us at:</p>
                <p><b>Route One Recruitment Services Ltd</b></p>
                <p>24 Colston Rise, Ampthill,
                    Bedford, England MK45 2GN</p>
                <p>info@routeonerecruitment.com</p>
                <br>

                <p>Best regards,</p>
                <p>English Teaching Team</p>
                <p>Route One Recruitment Services Ltd</p>

                <hr>
                <br>
                <div class="row">
                    <div class="col-4">
                        <i class="ph ph-map-pin"></i>
                        <p>24 Colston Rise, Ampthill,
                            Bedford, England MK45 2GN</p>
                    </div>
                    <div class="col-4">
                        <i class="ph ph-phone"></i>
                        <p>+44 20 313 78 313 <br>
                            +44 7361 496391
                        </p>
                    </div>
                    <div class="col-4">
                        <i class="ph ph-envelope-simple"></i>
                        <p>info@routeonerecruitment.com</p>
                        <p>www.routeonerecruitment.com</p>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card overflow-hidden p-16 col-4 m-12">
        <div class="card-body p-16">
            <h3>Certificate Details</h3>
            <form
                action="{{ isset($certificate) ? route('certificates.update', $certificate->id) : route('certificates.store') }}"
                method="POST" id="createCertificateForm">
                @csrf
                @if (isset($certificate))
                    @method('PUT') <!-- Use PUT for updates -->
                @endif
                <div class="form-row">
                    <div class="form-group col-md-12 mt-4">
                        <label>Current Date</label>
                        <input type="date" class="form-control" name="current_date" id="currentDate"
                            value="{{ isset($certificate) ? $certificate->current_date : $currentDate }}"
                            placeholder="Current Date" required>
                    </div>

                    <input type="hidden" name="application_id" value="{{ $application->id }}">
                    <input type="hidden" name="user_id" value="{{ $application->user_id }}">

                    <div class="form-group col-md-12 mt-4">
                        <label>Applicant Name</label>
                        <input type="text" class="form-control" name="applicant_name" id="applicantName"
                            value="{{ isset($certificate) ? $certificate->applicant_name : $application->name }}"
                            placeholder="Applicant Name" required>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob"
                            value="{{ isset($certificate) ? $certificate->dob : $application->dob }}"
                            placeholder="Date of Birth" required>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Result</label>
                        <select name="result" id="result-select" class="form-select py-9 placeholder-13 text-15 mb-10"
                            required>
                            <option value="" disabled {{ !isset($certificate) ? 'selected' : '' }}>Select Result
                            </option>
                            <option value="pass"
                                {{ isset($certificate) && $certificate->result == 'pass' ? 'selected' : '' }}>Pass
                            </option>
                            <option value="fail"
                                {{ isset($certificate) && $certificate->result == 'fail' ? 'selected' : '' }}>Fail
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Job Applied For</label>
                        <select name="job_id" id="jobApplied" class="form-select py-9 placeholder-13 text-15 mb-10">
                            @foreach ($jobs as $jobApplication)
                                <option value="{{ $jobApplication->job->id }}"
                                    data-title="{{ $jobApplication->job->title }}"
                                    {{ isset($certificate) && $certificate->job_id == $jobApplication->job->id ? 'selected' : '' }}>
                                    {{ $jobApplication->job->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Assessment Date</label>
                        <input type="date" class="form-control" name="assessment_date" id="assessmentDate"
                            value="{{ isset($certificate) ? $certificate->assessment_date : $currentDate }}"
                            placeholder="Assessment Date" required>
                    </div>

                    <div class="form-group col-md-12 mt-4">
                        <label>Confirmation Code</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="confirmationCode" name="confirmation_code"
                                value="{{ isset($certificate) ? $certificate->confirmation_code : '' }}"
                                placeholder="Confirmation Code" aria-describedby="basic-addon2" readonly required>
                            <div class="input-group-append">
                                <button class="btn btn-dark" id="generateCode" type="button">Generate</button>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-4 w-100" type="button" id="fillCertificate">Fill
                        Certificate</button>
                </div>
                <br>
                <button id="submit_button" disabled type="submit" class="btn btn-success w-100">
                    {{ isset($certificate) ? 'Update Certificate' : 'Create Certificate' }}
                </button>
            </form>

            <hr>

            <form action="{{ route('certificates.sendEmail') }}" method="POST">
                @csrf
                <div class="form-group col-md-12 mt-4">
                    <label>Email Address</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $application->email }}" placeholder="Email Address" required>

                    <input type="hidden" name="certificate_id"
                        value="{{ isset($certificate) ? $certificate->id : '' }}">
                </div>

                <button type="submit" class="btn btn-danger w-100 mt-2"
                    {{ isset($certificate) && $certificate->id ? '' : 'disabled' }}>
                    Email Certificate
                </button>
            </form>

            <!-- New button for downloading the certificate -->
            <form action="{{ route('certificates.download') }}" method="GET">
                <input type="hidden" name="certificate_id"
                    value="{{ isset($certificate) ? $certificate->id : '' }}">
                <button type="submit" class="btn btn-warning w-100 mt-2"
                    {{ isset($certificate) && $certificate->id ? '' : 'disabled' }}>
                    Download Certificate
                </button>
            </form>
        </div>
    </div>


</div>
<!-- Modal -->






@endsection

@push('scripts')
<script>
    document.getElementById('fillCertificate').addEventListener('click', function() {
        // Fetching values from the form
        const currentDate = document.getElementById('currentDate').value;
        const applicantName = document.getElementById('applicantName').value;
        const dob = document.getElementById('dob').value;
        // const jobApplied = document.getElementById('jobApplied').value;
        const jobSelect = document.getElementById('jobApplied');
        const jobId = jobSelect.value; // Get the selected job ID
        const selectedOption = jobSelect.options[jobSelect.selectedIndex]; // Get the selected option
        const jobTitle = selectedOption.getAttribute('data-title');

        const assessmentDate = document.getElementById('assessmentDate').value;
        const confirmationCode = document.getElementById('confirmationCode').value;

        const result = document.getElementById('result-select').value;

        // Validate that all fields are filled
        if (!currentDate || !applicantName || !dob || !jobApplied || !assessmentDate || !confirmationCode || !
            result) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill all required fields before filling the certificate.',
            });
            return; // Stop further execution
        }

        // Enable the "Save Certificate" button once all fields are filled
        document.getElementById('submit_button').disabled = false;

        // Updating the certificate fields (if all fields are filled)
        document.getElementById('current-date').textContent = currentDate;
        document.getElementById('applicant-name').textContent = applicantName;
        document.getElementById('dob-output').textContent = dob;
        document.getElementById('applied-job').textContent = jobTitle;
        document.getElementById('assesment-date').textContent = assessmentDate;
        document.getElementById('applicant-name-output').textContent = applicantName;
        document.getElementById('confirmation-code-output').textContent = confirmationCode;

        // Conditionally update the content based on the result
        const contentDiv = document.getElementById('content');
        if (result === 'pass') {
            contentDiv.innerHTML = `
            <p>We are pleased to inform you that you have successfully passed the English Language Proficiency
            Interview conducted by our team. Your English language skills meet the required standard for your applied
            job position at Route One Recruitment Services Ltd.</p>
            <br>
            <p>As a result, your application has automatically escalated to the next stage of the recruitment
            process. No further action is required regarding your English proficiency, and we will be in contact with
            the next steps soon.</p>
            <br>`;
        } else if (result === 'fail') {
            contentDiv.innerHTML =
                `<p>After reviewing your English Language Proficiency Interview, we regret to inform you that you did not meet the required standard for your applied job position at Route One Recruitment Services Ltd.</p>
            <br>
            <p>As a result, we are offering you the opportunity to enroll in our English Language Course to help improve your language skills and successfully re-qualify. You can choose from one of the following course durations:</p>
            <ul>
                <li>3-month course</li>
                <li>6-month course</li>
            </ul>
            <p>Upon successful completion of the course, you will have the chance to reapply for the interview.</p>
            <br>
            <p><b>Action Required: </b>Please contact us within 7 days to confirm your preferred course option and next steps.</p>
            <br>`;
        }
    });

    // Generate Confirmation Code button
    document.getElementById('generateCode').addEventListener('click', function() {
        const confirmationCode = Math.random().toString(36).substring(2, 10)
            .toUpperCase(); // Generate random code
        document.getElementById('confirmationCode').value = confirmationCode;
    });
</script>


<script>
    document.getElementById('result-select').addEventListener('change', function() {
        var result = this.value;
        var contentDiv = document.getElementById('content');

        if (result === 'pass') {
            contentDiv.innerHTML = `
            <p>We are pleased to inform you that you have successfully passed the English Language Proficiency
            Interview conducted by our team. Your English language skills meet the required standard for your applied
            job position at Route One Recruitment Services Ltd.</p>
            <br>
            <p>As a result, your application has automatically escalated to the next stage of the recruitment
            process. No further action is required regarding your English proficiency, and we will be in contact with
            the next steps soon.</p>
               <br>
        `;
        } else if (result === 'fail') {
            contentDiv.innerHTML = `
            <p>After reviewing your English Language Proficiency Interview, we regret to inform you that you did not meet the required standard for your applied job position at Route One Recruitment Services Ltd.</p>
            <br>
            <p>As a result, we are offering you the opportunity to enroll in our English Language Course to help improve your language skills and successfully re-qualify. You can choose from one of the following course durations:</p>
            <ul>
                <li>3-month course</li>
                <li>6-month course</li>
            </ul>
            <p>Upon successful completion of the course, you will have the chance to reapply for the interview.</p>
            <br>
            <p><b>Action Required: </b>Please contact us within 7 days to confirm your preferred course option and next steps.</p>
            <br>
        `;
        }
    });
</script>
<script>
    document.getElementById('generateCode').addEventListener('click', function() {
        var length = 8;
        var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var confirmationCode = "";

        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            confirmationCode += charset[randomIndex];
        }

        document.getElementById('confirmationCode').value = confirmationCode;
    });
</script>
@endpush
