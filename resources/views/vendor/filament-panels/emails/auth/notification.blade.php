{{-- ============================================================ --}}
{{-- System Notification Email — PlayTest ID Brand              --}}
{{-- Gmail-safe: table layout, inline styles, no SVG, no flex  --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light only">
    <title>{{ $subject }}</title>
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
            .email-card-body { padding:32px 22px 26px !important; }
            .email-hero { padding:36px 22px 28px !important; }
            .email-cta { padding:14px 30px !important; font-size:15px !important; }
            .h1-title { font-size:24px !important; }
            .hero-icon { width:72px !important; height:72px !important; }
            .hero-icon span { line-height:72px !important; font-size:32px !important; }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#eef0f7; font-family:'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; -webkit-font-smoothing:antialiased;">

    {{-- Preheader (hidden preview text) --}}
    <div style="display:none; font-size:1px; color:#eef0f7; line-height:1px; max-height:0; max-width:0; opacity:0; overflow:hidden;">
        {{ $title }} — Pemberitahuan dari PlayTest ID.
    </div>

    <!-- Outer wrapper -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:#eef0f7;">
        <tr>
            <td style="padding:44px 16px;" align="center">

                <!-- Email container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="580" class="email-container" style="max-width:580px; width:100%;">

                    {{-- ---- Brand header ---- --}}
                    <tr>
                        <td style="text-align:center; padding-bottom:24px;">
                            <img src="{{ asset('logo.png') }}" alt="PlayTest ID" height="42" style="display:inline-block; height:42px; width:auto; border:0;" />
                        </td>
                    </tr>

                    {{-- ---- Card ---- --}}
                    <tr>
                        <td>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 12px 40px rgba(79,70,229,0.12), 0 2px 6px rgba(17,24,39,0.04);">

                                {{-- Top gradient stripe --}}
                                <tr>
                                    <td style="height:6px; background:linear-gradient(90deg,#4F46E5 0%,#7c3aed 50%,#ec4899 100%); background-color:#4F46E5; font-size:0; line-height:0; mso-line-height-rule:exactly;">&nbsp;</td>
                                </tr>

                                {{-- Hero band --}}
                                <tr>
                                    <td class="email-hero" style="background:linear-gradient(160deg,#f5f3ff 0%,#eef2ff 100%); background-color:#f5f3ff; padding:44px 40px 28px; text-align:center;">

                                        {{-- Notification icon badge --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 22px;">
                                            <tr>
                                                <td class="hero-icon" width="80" height="80" align="center" valign="middle"
                                                    style="width:80px; height:80px; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; border-radius:24px; box-shadow:0 10px 28px rgba(79,70,229,0.40);">
                                                    <span style="font-size:36px; line-height:80px; display:block; color:#ffffff; mso-line-height-rule:exactly;">&#128276;</span>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:0 0 6px; font-size:13px; font-weight:700; color:#6366f1; letter-spacing:1.4px; text-transform:uppercase;">
                                            Pemberitahuan Sistem
                                        </p>

                                        <h1 class="h1-title" style="margin:0 0 12px; font-size:28px; font-weight:800; color:#1e1b4b; letter-spacing:-0.6px; line-height:1.2;">
                                            {{ $title }}
                                        </h1>

                                        <p style="margin:0; font-size:15px; color:#4b5563; line-height:1.75; font-weight:500;">
                                            Notifikasi dari platform <strong style="color:#1e1b4b;">PlayTest ID</strong>.
                                        </p>
                                    </td>
                                </tr>

                                {{-- Card body --}}
                                <tr>
                                    <td class="email-card-body" style="padding:32px 40px 36px;">

                                        {{-- Message content --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:28px;">
                                            <tr>
                                                <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-left:4px solid #4F46E5; border-radius:12px; padding:18px 20px;">
                                                    <p style="margin:0; font-size:15px; color:#374151; line-height:1.8; font-weight:500; white-space:pre-line;">{{ $messageText }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- CTA Button (if provided) --}}
                                        @if(!empty($buttonUrl) && !empty($buttonText))
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center" style="border-radius:14px; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; box-shadow:0 8px 22px rgba(79,70,229,0.38); mso-padding-alt:0;">
                                                    <!--[if mso]>
                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $buttonUrl }}" style="height:52px;v-text-anchor:middle;width:240px;" arcsize="27%" fillcolor="#4F46E5" stroke="f">
                                                    <w:anchorlock/>
                                                    <center style="color:#ffffff;font-family:'Segoe UI',sans-serif;font-size:16px;font-weight:700;">{{ $buttonText }}</center>
                                                    </v:roundrect>
                                                    <![endif]-->
                                                    <!--[if !mso]><!-->
                                                    <a href="{{ $buttonUrl }}" target="_blank" class="email-cta"
                                                        style="display:inline-block; background:linear-gradient(135deg,#4F46E5 0%,#7c3aed 100%); background-color:#4F46E5; color:#ffffff; text-decoration:none; font-size:16px; font-weight:800; padding:16px 40px; border-radius:14px; letter-spacing:0.3px;">
                                                        &#128279;&nbsp; {{ $buttonText }}
                                                    </a>
                                                    <!--<![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                        @endif

                                        {{-- Info chip --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:0 auto 28px;">
                                            <tr>
                                                <td align="center" style="padding:0 5px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                                        <tr>
                                                            <td style="background-color:#eef2ff; border:1px solid #c7d2fe; border-radius:9999px; padding:6px 14px; font-size:12px; font-weight:700; color:#4F46E5;">
                                                                &#128274;&nbsp; Email ini dikirim otomatis oleh sistem
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Divider --}}
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:20px;">
                                            <tr>
                                                <td style="height:1px; background-color:#e5e7eb; font-size:0; line-height:0;">&nbsp;</td>
                                            </tr>
                                        </table>

                                        {{-- Security note --}}
                                        <p style="margin:0; font-size:13px; color:#6b7280; text-align:center; line-height:1.7; font-weight:500;">
                                            Email ini dikirim secara otomatis. Harap tidak membalas email ini.<br>
                                            Jika Anda merasa tidak mengenal email ini, abaikan saja.
                                        </p>

                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    {{-- ---- Footer ---- --}}
                    <tr>
                        <td style="text-align:center; padding:28px 16px 0;">
                            <p style="margin:0 0 10px; font-size:13px; font-weight:700; color:#6b7280; letter-spacing:0.4px;">
                                PlayTest ID
                            </p>
                            <p style="margin:0; font-size:12px; color:#9ca3af; line-height:1.7; font-weight:500;">
                                Anda menerima email ini karena akun Anda terdaftar<br>
                                di platform PlayTest ID.
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
