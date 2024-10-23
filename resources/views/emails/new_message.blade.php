<!DOCTYPE html>
<html>
<head>
    <title>New Message</title>
</head>
<body>
    <h1>You have a new message from Route One Recruitement!</h1>
    <p><strong>From:</strong> {{ $sender->name }} ({{ $sender->email }})</p>
    <p><strong>Message:</strong> {{ $messageContent }}</p>
</body>
</html>