<!DOCTYPE html>
<html>
<head>
    <title>New Message Notification</title>
</head>
<body>
    <p>Hello,</p>
    <p>You have received a new message from <strong>{{ $sender->name }}</strong>:</p>
    <blockquote>
        "{{ $messageContent }}"
    </blockquote>
    <p>Check your inbox for more details.</p>




</body>
</html>
