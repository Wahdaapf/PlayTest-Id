{{-- ============================================================ --}}
{{-- Custom Password Reset Email — PlayTest ID Brand             --}}
{{-- Gmail-safe: table layout, inline styles, no SVG, no flex    --}}
{{-- Used in: App\Notifications\ResetPasswordNotification        --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Reset Your Password — PlayTest ID</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <style>
        td, th, div, p, a, h1, h2, h3, h4, h5, h6 { font-family: 'Segoe UI', sans-serif !important; }
    </style>
    <![endif]-->
    <style>
        /* Reset */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
        }

        /* Mobile */
        @media only screen and (max-width: 480px) {
            .email-container {
                width: 100% !important;
                max-width: 100% !important;
            }

            .email-card-body {
                padding: 28px 20px 24px !important;
            }

            .email-cta {
                padding: 13px 28px !important;
                font-size: 15px !important;
            }

            .email-info-table td {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
                padding: 4px 0 !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; -webkit-font-smoothing:antialiased;">

    <!-- Outer wrapper -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:#f3f4f6;">
        <tr>
            <td style="padding:40px 16px;" align="center">

                <!-- Email container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="560" class="email-container" style="max-width:560px; width:100%;">

                    {{-- ---- Brand header ---- --}}
                    <tr>
                        <td style="text-align:center; padding-bottom:28px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tr>
                                    {{-- Icon --}}
                                    <td width="44" height="44" align="center" valign="middle" style="width:44px; height:44px; background-color:#ffffff; border-radius:14px; border:1px solid #d1d5db; mso-border-alt:none; vertical-align: middle;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%; height:100%;">
                                            <tr>
                                                <td align="center" valign="middle" style="vertical-align: middle; padding-bottom: 3px;">
                                                    <span style="font-size:24px; line-height:1; display:inline-block; mso-line-height-rule:exactly;">&#127918;</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- Brand name --}}
                                    <td style="vertical-align:middle;">
                                        <span style="font-size:20px; font-weight:800; color:#111827; letter-spacing:-0.5px; padding-left: 16px;">PlayTest ID</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ---- Card ---- --}}
                    <tr>
                        <td>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#ffffff; border-radius:20px; overflow:hidden; box-shadow:0 4px 24px rgba(79,70,229,0.08);">

                                {{-- Top gradient stripe --}}
                                <tr>
                                    <td style="height:6px; background-color:#4F46E5; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>

                                {{-- Card body --}}
                                <tr>
                                    <td class="email-card-body" style="padding:40px 40px 32px;">

                                        {{-- Lock icon badge --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin-bottom:24px;">
                                            <tr>
                                                <td width="64" height="64" align="center" valign="middle" style="width:64px; height:64px; background-color:#EEF2FF; border:2px solid #C7D2FE; border-radius:18px;">
                                                    <span style="font-size:28px; line-height:64px;">&#128274;</span>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Greeting --}}
                                        <h1 style="margin:0 0 10px; font-size:22px; font-weight:800; color:#111827; text-align:center; letter-spacing:-0.4px;">Reset Your Password</h1>

                                        {{-- Body text --}}
                                        <p style="margin:0 0 28px; font-size:15px; color:#6b7280; line-height:1.7; text-align:center; font-weight:500;">
                                            Hey there! We received a request to reset the password<br>
                                            for your <strong style="color:#111827;">PlayTest ID</strong> account.<br>
                                            Click the button below to create a new password.
                                        </p>

                                        {{-- CTA Button --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center" style="border-radius:12px; background-color:#4F46E5; mso-padding-alt:0;">
                                                    <!--[if mso]>
                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $url }}" style="height:48px;v-text-anchor:middle;width:220px;" arcsize="25%" fillcolor="#4F46E5" stroke="f">
                                                    <w:anchorlock/>
                                                    <center style="color:#ffffff;font-family:'Segoe UI',sans-serif;font-size:16px;font-weight:700;">Reset My Password</center>
                                                    </v:roundrect>
                                                    <![endif]-->
                                                    <!--[if !mso]><!-->
                                                    <a href="{{ $url }}" target="_blank" class="email-cta" style="display:inline-block; background-color:#4F46E5; color:#ffffff; text-decoration:none; font-size:16px; font-weight:700; padding:14px 36px; border-radius:12px; letter-spacing:0.2px; mso-padding-alt:0;">
                                                        Reset My Password
                                                    </a>
                                                    <!--<![endif]-->
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Info chips --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" class="email-info-table" style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center" style="padding:0 5px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="background-color:#f3f4f6; border:1px solid #e5e7eb; border-radius:9999px; padding:5px 14px; font-size:12px; font-weight:600; color:#6b7280;">
                                                                &#128336;&nbsp; Expires in 60 minutes
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" style="padding:0 5px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="background-color:#f3f4f6; border:1px solid #e5e7eb; border-radius:9999px; padding:5px 14px; font-size:12px; font-weight:600; color:#6b7280;">
                                                                &#128737;&nbsp; Single-use link
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Divider --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:24px;">
                                            <tr>
                                                <td style="height:1px; background-color:#f3f4f6; font-size:0; line-height:0;">&nbsp;</td>
                                            </tr>
                                        </table>

                                        {{-- Security note --}}
                                        <p style="margin:0; font-size:13px; color:#9ca3af; text-align:center; line-height:1.6; font-weight:500;">
                                            Didn't request this? You can safely ignore this email.<br>
                                            Your password won't change until you click the button above.
                                        </p>

                                        {{-- Fallback URL --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:20px;">
                                            <tr>
                                                <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:14px 16px;">
                                                    <p style="margin:0 0 6px; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.6px;">
                                                        Having trouble with the button?
                                                    </p>
                                                    <p style="margin:0; font-size:11px; color:#4F46E5; word-break:break-all; line-height:1.5;">
                                                        Copy and paste this URL into your browser:<br>
                                                        <a href="{{ $url }}" style="color:#4F46E5; text-decoration:none;" target="_blank">{{ $url }}</a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    {{-- ---- Footer ---- --}}
                    <tr>
                        <td style="text-align:center; padding-top:24px;">
                            <p style="margin:0; font-size:12px; color:#9ca3af; line-height:1.7; font-weight:500;">
                                You're receiving this because a password reset was requested for<br>
                                your account at <strong style="color:#6b7280;">PlayTest ID</strong>
                            </p>
                            <p style="margin:8px 0 0; font-size:12px;">
                                <a href="{{ config('app.url') }}" style="color:#9ca3af; text-decoration:none; margin:0 8px;">Home</a>
                                <a href="{{ config('app.url') }}/privacy" style="color:#9ca3af; text-decoration:none; margin:0 8px;">Privacy</a>
                                <a href="{{ config('app.url') }}/terms" style="color:#9ca3af; text-decoration:none; margin:0 8px;">Terms</a>
                            </p>
                            <p style="margin:12px 0 0; font-size:11px; color:#d1d5db;">
                                &copy; {{ date('Y') }} PlayTest ID. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- /Email container -->

            </td>
        </tr>
    </table>
    <!-- /Outer wrapper -->

</body>

</html>