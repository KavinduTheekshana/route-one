<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Language Proficiency Interview Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background-color: #3e80f9;
            color: #ffffff;
            text-align: center;
            padding: 20px 10px;
        }
        .email-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            padding: 10px 20px;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <!-- Company Logo -->
            <h1>Interview Result Notification</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Dear {{ $certificate->applicant_name }},</p>

            <p>Attached is your English Language Proficiency Interview result.</p>

            <p>Best regards,</p>
            <p>Route One Recruitment Services Ltd</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Route One Recruitment Services Ltd. All rights reserved.</p>
            <p>
                <a href="https://routeonerecruitment.com" style="color: #3e80f9; text-decoration: none;">Visit our website</a> |
                <a href="mailto:info@routeonerecruitment.com" style="color: #3e80f9; text-decoration: none;">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
