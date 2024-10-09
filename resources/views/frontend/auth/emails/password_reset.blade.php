

{{-- <h1>Password Reset Request</h1>

<p>Hi {{ $user->name }},</p>
<p>We received a request to reset your password. Please click the link below to reset it:</p>

<a href="{{ url('password/reset', $token) }}">
    Reset Password
</a>

<p>If you didn’t request a password reset, please ignore this email.</p>

<p>Thanks!</p> --}}




<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; color: #333; padding: 100px 0;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <div style="background: #007bff; color: #ffffff; padding: 20px; text-align: center;">
            <h1 style="margin: 0;">Password Reset Request</h1>
        </div>
        <div style="padding: 20px;">
            <p style="line-height: 1.5; margin: 10px 0;">Hello {{ $user->name }},</p>
            <p style="line-height: 1.5; margin: 10px 0;">We received a request to reset your password. Click the button below to reset it:</p>
            <a href="{{ url('password/reset', $token) }}" style="display: inline-block; padding: 10px 20px; margin: 20px 0; color: #ffffff; background: #007bff; border-radius: 5px; text-decoration: none;">Reset Password</a>
            <p style="line-height: 1.5; margin: 10px 0;">If you did not request this, please ignore this email.</p>
            <p style="line-height: 1.5; margin: 10px 0;">Thank you!</p>
        </div>
        <div style="background: #f1f1f1; text-align: center; padding: 10px; font-size: 12px; color: #666;">
            <p>&copy; {{ date('Y') }} Route One Recruitment. All rights reserved.</p>
        </div>
    </div>
</body>
