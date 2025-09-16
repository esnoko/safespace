<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827;">
    <div style="max-width:600px;margin:0 auto;padding:24px;">
        <h1 style="color:#059669;">SafeSpace Verification Code</h1>
        <p>Hello {{ $school->name }},</p>
        <p>Use the verification code below to complete your login to the SafeSpace Admin Dashboard.</p>
        <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:8px;padding:16px;text-align:center;margin:16px 0;">
            <div style="font-size:28px;letter-spacing:6px;font-weight:bold;color:#065f46;">{{ $otp }}</div>
        </div>
        <p>This code expires in 10 minutes. If you did not request this code, you can safely ignore this email.</p>
        <p style="margin-top:24px;">Thanks,<br>SafeSpace</p>
    </div>
</body>
</html> 