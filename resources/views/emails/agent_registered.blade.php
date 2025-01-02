<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
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
            background-color: #3e80f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>Welcome to Our Platform!</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Hi {{ $agent->name }},</p>
            <p>Thank you for registering as an agent with us! We’re excited to have you join our platform.</p>
            <p>To complete your profile, please provide the required documents for verification. Our admin team will review them promptly and activate your account upon approval.</p>
            <p>Once your account is activated, you’ll be able to access all the tools and features designed to help you succeed as an agent.</p>

            <p style="text-align: center; margin: 20px 0;">
                <a href="{{ route('dashboard') }}" class="btn">Go to Dashboard</a>
            </p>

            <p>If you have any questions or need assistance, feel free to contact us. We’re here to help you every step of the way!</p>

            <p>Best regards,</p>
            <p>The Admin Team</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
            <p>
                <a href="http://routeonerecruitment.com" style="color: #3e80f9; text-decoration: none;">Visit our website</a> |
                <a href="mailto:support@example.com" style="color: #3e80f9; text-decoration: none;">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>