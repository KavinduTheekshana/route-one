<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Approved</title>
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3e80f9;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2c69e2;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <!-- Company Logo -->
            <h1>Application Approved</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Dear {{ $applicantName }},</p>

            <p>We are pleased to inform you that your application has been successfully approved.</p>

            <p>One of our team members will reach out to you shortly to guide you through the next steps in the process. In the
                meantime, if you have any questions or need assistance, please feel free to contact us at
                <a href="mailto:info@routeonerecruitment.com" style="color: #3e80f9;">info@routeonerecruitment.com</a>.</p>

            <p>Thank you for choosing Route One Recruitment Services Ltd. We look forward to supporting you in this journey!</p>

            <p>Best regards,<br>
                Route One Recruitment Services</p>
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
