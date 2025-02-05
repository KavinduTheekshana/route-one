<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COS Draft</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; }
        h1, h3 { text-align: center; }
        .section { margin-bottom: 15px; padding: 10px; border-bottom: 1px solid #000; }
        .label { font-weight: bold; display: inline-block; width: 200px; }
        .value { display: inline-block; }
    </style>
</head>
<body>

    <h1>Certificate of Sponsorship Details</h1>

    <h3>Tier and Category</h3>
    <div class="section">
        <p><span class="label">Tier and Category:</span> Skilled Worker (Switching immigration category - ISC liable)</p>
    </div>

    <h3>Certificate of Sponsorship Status</h3>
    <div class="section">
        <p><span class="label">Sponsor Licence Number:</span> 2B4F85FQ5</p>
        <p><span class="label">Sponsor Name:</span> GREEN EARTH CONSTRUCTION LTD</p>
        <p><span class="label">Certificate Number:</span> 1234567890</p>
        <p><span class="label">Current Certificate Status:</span> READY TO GO</p>
        <p><span class="label">Current Certificate Status Date:</span> 09 SEPTEMBER 2024</p>
        <p><span class="label">Date Assigned:</span> --</p>
        <p><span class="label">Expiry Date (Use By):</span> --</p>
        <p><span class="label">Sponsorship Withdrawn:</span> N</p>
        <p><span class="label">Sponsor Note:</span> --</p>
    </div>

    <h3>Personal Information</h3>
    <div class="section">
        <p><span class="label">Family Name:</span> {{ $application->name ?? 'Demo Name' }}</p>
        <p><span class="label">Given Name(s):</span> --</p>
        <p><span class="label">Nationality:</span> {{ $application->country ?? 'Demo Country' }}</p>
        <p><span class="label">Place of Birth:</span> --</p>
        <p><span class="label">Country of Birth:</span> --</p>
        <p><span class="label">Date of Birth:</span> {{ $application->dob ?? '01/01/1990' }}</p>
        <p><span class="label">Gender:</span> --</p>
        <p><span class="label">Country of Residence:</span> UNITED KINGDOM</p>
    </div>

    <h3>Passport or Travel Document</h3>
    <div class="section">
        <p><span class="label">Passport Number:</span> {{ $application->passport ?? 'N/A' }}</p>
        <p><span class="label">Issue Date:</span> --</p>
        <p><span class="label">Expiry Date:</span> --</p>
        <p><span class="label">Place of Issue:</span> --</p>
    </div>

    <h3>Current Home Address</h3>
    <div class="section">
        <p><span class="label">Address:</span> {{ $application->address ?? '123 Demo Street' }}</p>
        <p><span class="label">City/Town:</span> --</p>
        <p><span class="label">County/Province:</span> --</p>
        <p><span class="label">Postcode:</span> --</p>
        <p><span class="label">Country:</span> UNITED KINGDOM</p>
    </div>

    <h3>Work Dates</h3>
    <div class="section">
        <p><span class="label">Start Date:</span> 20 SEPTEMBER 2024</p>
        <p><span class="label">End Date:</span> 19 SEPTEMBER 2027</p>
        <p><span class="label">Weekly Hours:</span> 37.50</p>
    </div>

    <h3>Main Work Address in the UK</h3>
    <div class="section">
        <p><span class="label">Address:</span> 45 ISAAC STREET</p>
        <p><span class="label">City/Town:</span> LIVERPOOL</p>
        <p><span class="label">County:</span> MERSEYSIDE</p>
        <p><span class="label">Postcode:</span> L8 4TH</p>
    </div>

    <h3>Migrant's Employment</h3>
    <div class="section">
        <p><span class="label">Job Title:</span> BUILDER</p>
        <p><span class="label">Job Type:</span> 5319 Construction and building trades</p>
        <p><span class="label">Gross Salary (£):</span> 38,700.00</p>
        <p><span class="label">On Immigration Salary List:</span> Y</p>
        <p><span class="label">Meets Skill Level:</span> Y</p>
        <p><span class="label">Certified Maintenance:</span> Y</p>
    </div>

    <h3>PAYE Reference</h3>
    <div class="section">
        <p><span class="label">PAYE Reference Number:</span> 120/KE58255</p>
    </div>

    <h3>Job Description</h3>
    <div class="section">
        <p>PREPARING AND SECURING CONSTRUCTION SITES, ENSURING COMPLIANCE WITH HEALTH AND SAFETY REGULATIONS. READING AND INTERPRETING BLUEPRINTS, DRAWINGS, AND SPECIFICATIONS TO DETERMINE PROJECT REQUIREMENTS...</p>
    </div>

</body>
</html>
