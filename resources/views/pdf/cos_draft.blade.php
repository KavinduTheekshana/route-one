<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>COS Draft</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h1,
        h3 {
            text-align: center;
        }

        .section {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #000;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }

        .value {
            display: inline-block;
        }

        .barcode-container {
            text-align: center;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .barcode {
            display: block;
            text-align: center;
        }

        .barcode-number {
            font-weight: bold;
            margin-top: 10px;
            /* Adds space between barcode and number */
        }
    </style>
</head>

<body>

    <h1>Certificate of Sponsorship Details</h1>

    <div style="width: 100%; text-align: center;">
        @if ($draft->barcode)
            <table align="center">
                <tr>
                    <td style="text-align: center;">
                        {!! DNS1D::getBarcodeHTML($draft->barcode, 'C128', 2, 50) !!}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bold; margin-top: 10px;">
                        Barcode Number: {{ $draft->barcode }}
                    </td>
                </tr>
            </table>
        @endif
    </div>




    <h3>Tier and Category</h3>
    <div class="section">
        <p><span class="label">Tier and Category:</span> Skilled Worker (Switching immigration category - ISC liable)
        </p>
    </div>

    <h3>Certificate of Sponsorship Status</h3>
    <div class="section">
        <p><span class="label">Sponsor Licence Number:</span> {{ $draft->sponsor_license_number }}</p>
        <p><span class="label">Sponsor Name:</span> {{ $draft->sponsor_name }}</p>
        <p><span class="label">Certificate Number:</span> {{ $draft->certificate_number }}</p>
        <p><span class="label">Current Certificate Status:</span> {{ $draft->status }}</p>
        <p><span class="label">Current Certificate Status Date:</span> {{ $draft->current_certificate_status_date }}
        </p>
        <p><span class="label">Date Assigned:</span> {{ $draft->date_assign }}</p>
        <p><span class="label">Expiry Date (Use By):</span> {{ $draft->expire_date }}</p>
        <p><span class="label">Sponsorship Withdrawn:</span> N</p>
        <p><span class="label">Sponsor Note:</span> {{ $draft->sponsor_note }}</p>
    </div>

    <h3>Personal Information</h3>
    <div class="section">
        <p><span class="label">Family Name:</span> {{ $draft->family_name }}</p>
        <p><span class="label">Given Name(s):</span> {{ $draft->given_name }}</p>
        <p><span class="label">Other names:</span> {{ $draft->Other_names }}</p>
        <p><span class="label">Nationality:</span> {{ $draft->nationality }}</p>
        <p><span class="label">Place of Birth:</span> {{ $draft->place_of_birth }}</p>
        <p><span class="label">Country of Birth:</span> {{ $draft->country_of_birth }}</p>
        <p><span class="label">Date of Birth:</span> {{ $draft->dob }}</p>
        <p><span class="label">Gender:</span> {{ $draft->gender }}</p>
        <p><span class="label">Country of Residence:</span> {{ $draft->country_of_residence }}</p>
    </div>

    <h3>Passport or Travel Document</h3>
    <div class="section">
        <p><span class="label">Passport Number:</span> {{ $draft->passport }}</p>
        <p><span class="label">Issue Date:</span> {{ $draft->issue_date }}</p>
        <p><span class="label">Expiry Date:</span> {{ $draft->expiry_date }}</p>
        <p><span class="label">Place of Issue:</span> {{ $draft->place_of_issue }}</p>
    </div>

    <h3>Current Home Address</h3>
    <div class="section">
        <p><span class="label">Address:</span> {{ $draft->address }}</p>
        <p><span class="label">City/Town:</span> {{ $draft->city }}</p>
        <p><span class="label">County, area district or province:</span> {{ $draft->county }}</p>
        <p><span class="label">Postcode:</span> {{ $draft->postcode }}</p>
        <p><span class="label">Country:</span> {{ $draft->country }}</p>
    </div>

    <h3>Work Dates</h3>
    <div class="section">
        <p><span class="label">Start Date:</span> {{ $draft->start_date }}</p>
        <p><span class="label">End Date:</span> {{ $draft->end_date }}</p>
        <p><span class="label">Weekly Hours:</span> {{ $draft->hours_of_work }}</p>
    </div>

    <h3>Main Work Address in the UK (Optional)</h3>
    <div class="section">
        <p><span class="label">Address:</span> {{ $draft->work_address }}</p>
        <p><span class="label">City/Town:</span> {{ $draft->work_city }}</p>
        <p><span class="label">County:</span> {{ $draft->work_county }}</p>
        <p><span class="label">Postcode:</span> {{ $draft->work_postcode }}</p>
    </div>

    <h3>Migrant's Employment</h3>
    <div class="section">
        <p><span class="label">Job Title:</span> {{ $draft->job_title }}</p>
        <p><span class="label">Job Type:</span> {{ $draft->job_type }}</p>
        <p><span class="label">Gross Salary (£):</span> {{ $draft->salary }}</p>
        <p><span class="label">On Immigration Salary List:</span> Y</p>
        <p><span class="label">Meets Skill Level:</span> Y</p>
        <p><span class="label">Certified Maintenance:</span> Y</p>
    </div>

    <h3>PAYE Reference</h3>
    <div class="section">
        <p><span class="label">PAYE Reference Number:</span> {{ $draft->paye_reference }}</p>
    </div>

    <h3>Job Description</h3>
    <div class="section">
        <p>{{ $draft->description }}</p>
    </div>

    <p style="font-size: 10px; color: rgb(100, 100, 100)">This is the assigned Certificate of Sponsorship (COS). Please
        review the details carefully to ensure accuracy. This document has been generated exclusively for use by the
        Route One Recruitment office. Any fake or duplicate copies can be verified via our barcode verification link:
        https://www.routeonerecruitment.com/verify/cos</p>
</body>

</html>
