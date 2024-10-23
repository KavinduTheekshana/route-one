<!-- resources/views/emails/new_message.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New Message</title>
    <style>
        /* Optional: You can add some styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>You have a new message from Route One Recruitment!</h1>
    <p><strong>From:</strong> {{ $sender->name }} ({{ $sender->email }})</p>
    <p><strong>Message:</strong> {{ $messageContent }}</p>

    <div class="footer">
        <p><em>Please do not reply to this email. Contact your agent for assistance.</em></p>
    </div>
</body>
</html>
