<!-- resources/views/auth/emails/password_reset.blade.php -->

<h1>Password Reset Request</h1>

<p>Hi {{ $user->name }},</p>
<p>We received a request to reset your password. Please click the link below to reset it:</p>

<a href="{{ url('password/reset', [$token, 'code' => $verification_code]) }}">
    Reset Password
</a>

<p>If you didn’t request a password reset, please ignore this email.</p>

<p>Thanks!</p>
