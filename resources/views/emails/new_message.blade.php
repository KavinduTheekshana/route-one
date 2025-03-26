<!-- resources/views/emails/new_message.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>New Message</title>
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

        .email-body {
            padding: 20px 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-body h1 {
            font-size: 20px;
            color: #3e80f9;
        }

        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            padding: 10px 20px;
            font-size: 14px;
            color: #666666;
        }

        .email-footer em {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>New Message Notification</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <h1>You have a new message from Route One Recruitment!</h1>
            <p><strong>From:</strong> {{ $sender->name }} ({{ $sender->email }})</p>
            <p>{!! $messageContent !!}</p>

            @if (!empty($attachments))
                <p><strong>Attachments:</strong></p>
                <ul>
                    @foreach ($attachments as $attachment)
                        <li>
                            <a href="{{ $attachment['url'] }}" target="_blank">{{ $attachment['original_name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p><em>Please do not reply to this email. Contact your agent for assistance.</em></p>
            <p>&copy; {{ date('Y') }} Route One Recruitment Services Ltd. All rights reserved.</p>
            <p>
                <a href="https://routeonerecruitment.com" style="color: #3e80f9; text-decoration: none;">Visit our
                    website</a> |
                <a href="mailto:info@routeonerecruitment.com" style="color: #3e80f9; text-decoration: none;">Contact
                    Support</a>
            </p>
        </div>
    </div>
</body>

</html>
