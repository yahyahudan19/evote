<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Akses eVote</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <!-- Wrapper Table -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f3f4f6;">
        <tr>
            <td style="padding: 40px 20px;">
                <!-- Main Container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); padding: 40px 30px; text-align: center; border-radius: 16px 16px 0 0;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="text-align: center;">
                                        <!-- Logo -->
                                        <div style="width: 70px; height: 70px; background-color: rgba(255, 255, 255, 0.2); border-radius: 16px; margin: 0 auto 20px auto; line-height: 70px; text-align: center; border: 1px solid rgba(255, 255, 255, 0.3);">
                                            <span style="color: #ffffff; font-size: 24px; font-weight: bold;">eV</span>
                                        </div>
                                        <h1 style="margin: 0 0 8px 0; font-size: 28px; color: #ffffff; font-weight: bold; letter-spacing: -0.5px;">Kode Akses eVote</h1>
                                        <p style="margin: 0; color: rgba(255, 255, 255, 0.9); font-size: 16px;">Sistem Pemilihan Elektronik</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                
                                <!-- Greeting -->
                                <tr>
                                    <td style="padding-bottom: 24px;">
                                        <p style="margin: 0; font-size: 18px; color: #374151; line-height: 1.6;">
                                            Halo <strong style="color: #1f2937; font-weight: bold;">{{ $voter->name }}</strong>,
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- Description -->
                                <tr>
                                    <td style="padding-bottom: 32px;">
                                        <p style="margin: 0; font-size: 16px; color: #6b7280; line-height: 1.7;">
                                            Kami telah menyiapkan kode akses untuk partisipasi Anda dalam sistem eVote. Gunakan informasi berikut untuk mengakses platform pemilihan.
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- User Information Card -->
                                <tr>
                                    <td style="padding-bottom: 32px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e5e7eb;">
                                            <tr>
                                                <td style="padding: 24px;">
                                                    <h3 style="margin: 0 0 20px 0; color: #1e293b; font-size: 18px; font-weight: bold;">📋 Informasi Pemilih</h3>
                                                    
                                                    <!-- Name Row -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                                        <tr>
                                                            <td style="width: 40px; vertical-align: top; padding-right: 12px;">
                                                                <div style="width: 32px; height: 32px; background-color: #3b82f6; border-radius: 8px; text-align: center; line-height: 32px;">
                                                                    <span style="color: #ffffff; font-size: 16px;">👤</span>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold;">Nama Lengkap</p>
                                                                <p style="margin: 0; font-size: 16px; color: #1e293b; font-weight: bold;">{{ $voter->name }}</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- Email Row -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                                        <tr>
                                                            <td style="width: 40px; vertical-align: top; padding-right: 12px;">
                                                                <div style="width: 32px; height: 32px; background-color: #10b981; border-radius: 8px; text-align: center; line-height: 32px;">
                                                                    <span style="color: #ffffff; font-size: 16px;">✉️</span>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold;">Email</p>
                                                                <p style="margin: 0; font-size: 16px; color: #1e293b; font-weight: bold;">{{ $voter->email }}</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <!-- Phone Row -->
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td style="width: 40px; vertical-align: top; padding-right: 12px;">
                                                                <div style="width: 32px; height: 32px; background-color: #f59e0b; border-radius: 8px; text-align: center; line-height: 32px;">
                                                                    <span style="color: #ffffff; font-size: 16px;">📱</span>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <p style="margin: 0 0 4px 0; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold;">No. Telepon</p>
                                                                <p style="margin: 0; font-size: 16px; color: #1e293b; font-weight: bold;">{{ $voter->phone }}</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Access Code Card -->
                                <tr>
                                    <td style="padding-bottom: 32px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 16px;">
                                            <tr>
                                                <td style="padding: 32px; text-align: center;">
                                                    <div style="width: 50px; height: 50px; background-color: #6366f1; border-radius: 12px; margin: 0 auto 16px auto; text-align: center; line-height: 50px;">
                                                        <span style="color: #ffffff; font-size: 20px;">🔐</span>
                                                    </div>
                                                    <p style="margin: 0 0 16px 0; color: #94a3b8; font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: bold;">Kode Verifikasi</p>
                                                    <div style="font-family: 'Courier New', Courier, monospace; font-size: 32px; font-weight: bold; color: #ffffff; letter-spacing: 6px; padding: 20px; background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; border: 2px solid rgba(255, 255, 255, 0.2); margin: 16px 0;">
                                                        {{ $voter->code }}
                                                    </div>
                                                    <p style="margin: 16px 0 0 0; color: #cbd5e1; font-size: 14px; line-height: 1.5;">Kode ini bersifat rahasia dan personal</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Security Notice -->
                                <tr>
                                    <td style="padding-bottom: 24px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fef3c7; border-radius: 10px; border-left: 4px solid #f59e0b;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td style="width: 32px; vertical-align: top; padding-right: 12px;">
                                                                <div style="width: 24px; height: 24px; background-color: #f59e0b; border-radius: 50%; text-align: center; line-height: 24px;">
                                                                    <span style="color: #ffffff; font-size: 14px; font-weight: bold;">!</span>
                                                                </div>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <h4 style="margin: 0 0 8px 0; color: #92400e; font-size: 16px; font-weight: bold;">Penting untuk Diingat</h4>
                                                                <p style="margin: 0; color: #a16207; font-size: 14px; line-height: 1.6;">Jaga kerahasiaan kode verifikasi Anda. Jangan bagikan kepada siapa pun. Kode ini hanya berlaku untuk satu kali pemilihan.</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Instructions -->
                                <tr>
                                    <td style="padding-bottom: 32px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #ffffff; border: 2px solid #e5e7eb; border-radius: 10px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <h4 style="margin: 0 0 16px 0; color: #1e293b; font-size: 16px; font-weight: bold;">📝 Langkah Selanjutnya:</h4>
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td style="color: #64748b; font-size: 14px; line-height: 1.8;">
                                                                <p style="margin: 0 0 8px 0;">1. Akses platform eVote melalui link yang telah disediakan</p>
                                                                <p style="margin: 0 0 8px 0;">2. Masukkan kode verifikasi di atas</p>
                                                                <p style="margin: 0 0 8px 0;">3. Verifikasi identitas Anda</p>
                                                                <p style="margin: 0;">4. Lakukan pemilihan sesuai preferensi Anda</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 24px 30px; text-align: center; border-top: 1px solid #e5e7eb; border-radius: 0 0 16px 16px;">
                            <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px; font-weight: 500;">Terima kasih atas partisipasi Anda dalam sistem demokrasi digital</p>
                            <p style="margin: 0 0 16px 0; color: #94a3b8; font-size: 13px; font-weight: bold;">Tim eVote Indonesia</p>
                            <div style="border-top: 1px solid #e5e7eb; padding-top: 12px;">
                                <p style="margin: 0; font-size: 12px; color: #94a3b8;">&copy; {{ date('Y') }} eVote Indonesia. Semua hak cipta dilindungi undang-undang.</p>
                            </div>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>