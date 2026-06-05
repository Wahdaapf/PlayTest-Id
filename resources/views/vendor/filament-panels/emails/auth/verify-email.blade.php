{{-- ============================================================ --}}
{{-- Custom Email Verification Email — PlayTest ID Brand (v2)   --}}
{{-- Gmail-safe: table layout, inline styles, no SVG, no flex   --}}
{{-- Used in: App\Notifications\VerifyEmailNotification         --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light only">
    <title>Verify Your Email — PlayTest ID</title>
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
        body, table, td, a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
        table, td { mso-table-lspace:0pt; mso-table-rspace:0pt; }
        img { -ms-interpolation-mode:bicubic; border:0; height:auto; line-height:100%; outline:none; text-decoration:none; }
        body { margin:0; padding:0; width:100% !important; height:100% !important; }
        a { color:#4F46E5; }

        @media only screen and (max-width: 480px) {
            .email-container { width:100% !important; max-width:100% !important; }
            .email-card-body { padding:30px 22px 28px !important; }
            .email-hero { padding:40px 22px 30px !important; }
            .email-cta { padding:15px 32px !important; font-size:15px !important; }
            .step-cell { display:block !important; width:100% !important; padding:10px 0 !important; }
            .step-arrow { display:none !important; }
            .h1-title { font-size:26px !important; }
            .hero-icon { width:80px !important; height:80px !important; }
            .hero-icon span { line-height:80px !important; font-size:36px !important; }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#eef0f7; font-family:'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; -webkit-font-smoothing:antialiased;">

    {{-- Preheader --}}
    <div style="display:none; font-size:1px; color:#eef0f7; line-height:1px; max-height:0; max-width:0; opacity:0; overflow:hidden;">
        Welcome to PlayTest ID! Verify your email to activate your account and start earning.
    </div>

    <!-- Outer wrapper -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:#eef0f7;">
        <tr>
            <td style="padding:44px 16px;" align="center">

                <!-- Email container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="580" class="email-container" style="max-width:580px; width:100%;">

                    {{-- ──────────── Brand Header ──────────── --}}
                    <tr>
                        <td style="text-align:center; padding-bottom:24px;">
                            <img src="{{ asset('logo.png') }}" alt="PlayTest ID" height="42" style="display:inline-block; height:42px; width:auto; border:0;" />
                        </td>
                    </tr>

                    {{-- ──────────── Main Card ──────────── --}}
                    <tr>
                        <td>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 12px 40px rgba(79,70,229,0.14), 0 2px 6px rgba(17,24,39,0.04);">

                                {{-- Top gradient stripe --}}
                                <tr>
                                    <td style="height:6px; background:linear-gradient(90deg,#4F46E5 0%,#7c3aed 50%,#ec4899 100%); background-color:#4F46E5; font-size:0; line-height:0; mso-line-height-rule:exactly;">&nbsp;</td>
                                </tr>

                                {{-- Hero area --}}
                                <tr>
                                    <td class="email-hero" style="background:linear-gradient(160deg,#eef2ff 0%,#f5f3ff 50%,#fdf2f8 100%); background-color:#eef2ff; padding:48px 40px 36px; text-align:center;">

                                        {{-- Shield / verify icon badge --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 24px;">
                                            <tr>
                                                <td class="hero-icon" width="88" height="88" align="center" valign="middle"
                                                    style="width:88px; height:88px; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; border-radius:26px; box-shadow:0 12px 32px rgba(79,70,229,0.42);">
                                                    <span style="font-size:42px; line-height:88px; display:block; color:#ffffff; font-weight:700; mso-line-height-rule:exactly;">&#10003;</span>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Greeting + headline --}}
                                        @if(!empty($userName))
                                        <p style="margin:0 0 8px; font-size:13px; font-weight:700; color:#6366f1; letter-spacing:1.4px; text-transform:uppercase;">
                                            &#127881;&nbsp; Welcome Aboard
                                        </p>
                                        <h1 class="h1-title" style="margin:0 0 12px; font-size:30px; font-weight:800; color:#1e1b4b; letter-spacing:-0.6px; line-height:1.2;">
                                            Hi, {{ $userName }}!
                                        </h1>
                                        @else
                                        <p style="margin:0 0 8px; font-size:13px; font-weight:700; color:#6366f1; letter-spacing:1.4px; text-transform:uppercase;">
                                            One Last Step
                                        </p>
                                        <h1 class="h1-title" style="margin:0 0 12px; font-size:30px; font-weight:800; color:#1e1b4b; letter-spacing:-0.6px; line-height:1.2;">
                                            Verify Your Email
                                        </h1>
                                        @endif

                                        <p style="margin:0; font-size:15px; color:#4b5563; line-height:1.75; font-weight:500;">
                                            You're almost there! Confirm your email to activate your<br>
                                            <strong style="color:#4F46E5;">PlayTest ID</strong> account and start earning by testing apps.
                                        </p>
                                    </td>
                                </tr>

                                {{-- Card body --}}
                                <tr>
                                    <td class="email-card-body" style="padding:36px 40px 36px;">

                                        {{-- CTA Button --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center" style="border-radius:14px; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; box-shadow:0 8px 24px rgba(79,70,229,0.40); mso-padding-alt:0;">
                                                    <!--[if mso]>
                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $url }}" style="height:54px;v-text-anchor:middle;width:260px;" arcsize="26%" fillcolor="#4F46E5" stroke="f">
                                                    <w:anchorlock/>
                                                    <center style="color:#ffffff;font-family:'Segoe UI',sans-serif;font-size:16px;font-weight:700;">Verify My Email</center>
                                                    </v:roundrect>
                                                    <![endif]-->
                                                    <!--[if !mso]><!-->
                                                    <a href="{{ $url }}" target="_blank" class="email-cta"
                                                        style="display:inline-block; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; color:#ffffff; text-decoration:none; font-size:16px; font-weight:800; padding:17px 44px; border-radius:14px; letter-spacing:0.3px;">
                                                        &#10003;&nbsp; Verify My Email Address
                                                    </a>
                                                    <!--<![endif]-->
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Info badges --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 30px;">
                                            <tr>
                                                <td align="center" style="padding:0 5px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="background-color:#eef2ff; border:1px solid #c7d2fe; border-radius:9999px; padding:6px 14px; font-size:12px; font-weight:700; color:#4F46E5;">
                                                                &#128336;&nbsp; Expires in 60 minutes
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" style="padding:0 5px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="background-color:#eef2ff; border:1px solid #c7d2fe; border-radius:9999px; padding:6px 14px; font-size:12px; font-weight:700; color:#4F46E5;">
                                                                &#128737;&nbsp; Single-use link
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Section title --}}
                                        <p style="margin:0 0 18px; font-size:13px; font-weight:800; color:#1e1b4b; text-align:center; text-transform:uppercase; letter-spacing:1.2px;">
                                            What happens next?
                                        </p>

                                        {{-- Steps --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:28px;">
                                            <tr>
                                                <!-- Step 1 -->
                                                <td class="step-cell" align="center" valign="top" style="width:33%; padding:0 8px; text-align:center;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                                        <tr>
                                                            <td width="48" height="48" align="center" valign="middle"
                                                                style="width:48px; height:48px; background:linear-gradient(135deg,#eef2ff 0%,#e0e7ff 100%); background-color:#eef2ff; border:1px solid #c7d2fe; border-radius:50%; font-size:20px; line-height:48px; mso-line-height-rule:exactly;">
                                                                &#128231;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:10px; font-size:12px; font-weight:800; color:#1e1b4b; text-align:center; letter-spacing:0.2px;">
                                                                Click Button
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:2px; font-size:11px; color:#9ca3af; text-align:center;">
                                                                Confirm it's you
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Arrow -->
                                                <td class="step-arrow" align="center" valign="middle" style="width:14px; color:#c7d2fe; font-size:18px; font-weight:700;">&#8594;</td>
                                                <!-- Step 2 -->
                                                <td class="step-cell" align="center" valign="top" style="width:33%; padding:0 8px; text-align:center;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                                        <tr>
                                                            <td width="48" height="48" align="center" valign="middle"
                                                                style="width:48px; height:48px; background:linear-gradient(135deg,#eef2ff 0%,#e0e7ff 100%); background-color:#eef2ff; border:1px solid #c7d2fe; border-radius:50%; font-size:20px; line-height:48px; mso-line-height-rule:exactly;">
                                                                &#9989;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:10px; font-size:12px; font-weight:800; color:#1e1b4b; text-align:center; letter-spacing:0.2px;">
                                                                Email Verified
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:2px; font-size:11px; color:#9ca3af; text-align:center;">
                                                                Account activated
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Arrow -->
                                                <td class="step-arrow" align="center" valign="middle" style="width:14px; color:#c7d2fe; font-size:18px; font-weight:700;">&#8594;</td>
                                                <!-- Step 3 -->
                                                <td class="step-cell" align="center" valign="top" style="width:33%; padding:0 8px; text-align:center;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                                        <tr>
                                                            <td width="48" height="48" align="center" valign="middle"
                                                                style="width:48px; height:48px; background:linear-gradient(135deg,#fdf2f8 0%,#fce7f3 100%); background-color:#fdf2f8; border:1px solid #fbcfe8; border-radius:50%; font-size:20px; line-height:48px; mso-line-height-rule:exactly;">
                                                                &#127919;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:10px; font-size:12px; font-weight:800; color:#1e1b4b; text-align:center; letter-spacing:0.2px;">
                                                                Start Earning
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-top:2px; font-size:11px; color:#9ca3af; text-align:center;">
                                                                Test &amp; get paid
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Divider --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:22px;">
                                            <tr>
                                                <td style="height:1px; background-color:#e5e7eb; font-size:0; line-height:0;">&nbsp;</td>
                                            </tr>
                                        </table>

                                        {{-- Security note --}}
                                        <p style="margin:0 0 18px; font-size:13px; color:#6b7280; text-align:center; line-height:1.7; font-weight:500;">
                                            If you didn't create an account, you can safely ignore this email.<br>
                                            No changes will be made to any account.
                                        </p>

                                        {{-- Fallback URL --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:12px; padding:14px 18px;">
                                                    <p style="margin:0 0 6px; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px;">
                                                        Button not working? Copy this link:
                                                    </p>
                                                    <p style="margin:0; font-size:12px; color:#4F46E5; word-break:break-all; line-height:1.55;">
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

                    {{-- ──────────── Footer ──────────── --}}
                    <tr>
                        <td style="text-align:center; padding:28px 16px 0;">
                            <p style="margin:0 0 10px; font-size:13px; font-weight:700; color:#6b7280; letter-spacing:0.4px;">
                                PlayTest ID
                            </p>
                            <p style="margin:0; font-size:12px; color:#9ca3af; line-height:1.7; font-weight:500;">
                                You received this because an account was created<br>
                                with this email address.
                            </p>
                            <p style="margin:14px 0 0; font-size:12px;">
                                <a href="{{ config('app.url') }}" style="color:#6b7280; text-decoration:none; margin:0 10px; font-weight:600;">Home</a>
                                <span style="color:#d1d5db;">&middot;</span>
                                <a href="{{ config('app.url') }}/privacy" style="color:#6b7280; text-decoration:none; margin:0 10px; font-weight:600;">Privacy</a>
                                <span style="color:#d1d5db;">&middot;</span>
                                <a href="{{ config('app.url') }}/terms" style="color:#6b7280; text-decoration:none; margin:0 10px; font-weight:600;">Terms</a>
                            </p>
                            <p style="margin:14px 0 0; font-size:11px; color:#9ca3af;">
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
