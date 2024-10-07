<!DOCTYPE html>
<html>

<head>
    <title>Certificate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        a:hover {
            text-decoration: none !important;
        }

        p {
            margin: 0 !important;
            ;
        }

        .light-text {
            font-weight: 100;
            color: rgb(0, 0, 0) !important;
        }

        .mt-4 {
            margin-top: 20px !important;
        }

        .mt-2 {
            margin-top: 10px !important;
        }
    </style>
</head>

<body>

    <div class="certificate">
        <img src="{{ public_path('backend/images/logo/routeone_logo.png') }}" style="width: 250px" alt="">

        <h4 style="margin-top: 30px"><b>Route One Recruitment Services Ltd
                <br>English Language Proficiency Interview Result</b></h4>

        <br>
        <p>Date of Issue: <span class="light-text"
                id="current-date">{{ $certificate->current_date ?? $currentDate }}</span></p>
        <p>Validity Period: <span class="light-text">1 Year</span></p>
        <p>Applicant Name: <span class="light-text" id="applicant-name">{{ $certificate->applicant_name ?? '' }}</span>
        </p>
        <p>Date of Birth: <span class="light-text" id="dob-output">{{ $certificate->dob ?? '' }}</span></p>
        <p>Job Applied For: <span class="light-text" id="applied-job">{{ $vacancies->title ?? '' }}</span></p>
        <p>Assessment Date: <span class="light-text"
                id="assesment-date">{{ $certificate->assessment_date ?? '' }}</span></p>
        <br>
        <p>Dear <span class="light-text" id="applicant-name-output">{{ $certificate->applicant_name ?? '' }}</span>,</p>
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

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 33%; text-align: center; padding: 10px;">
                    <!-- Location icon SVG -->
                    <img src="{{ public_path('backend/images/icons/map-pin.png') }}" style="width: 15px" alt="">
                    <p>24 Colston Rise, Ampthill,<br>Bedford, England MK45 2GN</p>
                </td>
                <td style="width: 33%; text-align: center; padding: 10px;">
                    <!-- Phone icon SVG -->
                    <img src="{{ public_path('backend/images/icons/phone.png') }}" style="width: 15px" alt="">
                    <p>+44 20 313 78 313<br>+44 7361 496391</p>
                </td>
                <td style="width: 33%; text-align: center; padding: 10px;">
                    <!-- Envelope icon SVG -->
                    <img src="{{ public_path('backend/images/icons/envelope.png') }}" style="width: 15px"
                        alt="">
                    <p>info@routeonerecruitment.com<br>www.routeonerecruitment.com</p>
                </td>
            </tr>
        </table>




    </div>
</body>

</html>
