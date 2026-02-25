<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Technorics</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #059669, #047857); padding: 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Reset Your Password</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;">
                                Hello!
                            </p>
                            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;">
                                You are receiving this email because we received a password reset request for your Technorics account.
                            </p>
                            <p style="text-align: center; margin: 30px 0;">
                                <a href="{{ $resetUrl }}" style="display: inline-block; background: linear-gradient(135deg, #059669, #047857); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 8px; font-size: 16px; font-weight: bold;">
                                    Reset Password
                                </a>
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6; margin: 20px 0 0 0;">
                                This password reset link will expire in 60 minutes.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6; margin: 20px 0 0 0;">
                                If you did not request a password reset, no further action is required.
                            </p>
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
                            <p style="color: #9ca3af; font-size: 12px; line-height: 1.6; margin: 0;">
                                If you're having trouble clicking the button, copy and paste this URL into your browser:<br>
                                <span style="color: #059669;">{{ $resetUrl }}</span>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #6b7280; font-size: 14px; margin: 0;">
                                © 2024 Technorics Electronics. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
