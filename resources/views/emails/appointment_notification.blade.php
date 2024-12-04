<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Notification</title>
</head>
<body>
    <p>Dear {{ $appointment->title }},</p>
    <p>A new appointment has been scheduled for you:</p>
    <ul>
        <li><strong>Service:</strong> {{ $appointment->service->service_name }}</li>
        <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start)->format('D, F j, Y') }}</li>
        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->start)->format('g:i A') }} - {{ \Carbon\Carbon::parse($appointment->end)->format('g:i A') }}</li>
        <li><strong>Description:</strong> {!! $appointment->description !!}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>
