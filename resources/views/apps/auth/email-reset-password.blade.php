<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password - E-Arsip BRMP Mektan</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; padding:30px; border-radius:8px;">
                    <tr>
                        <td align="center">
                            {{-- <!-- Logo -->
                            <a href="{{ route('login') }}">
                                <img src="https://yourdomain.com/admin/assets/img/logo-kementan.png" alt="Logo-Kementan" width="150" style="display:block; margin-bottom:20px;">
                            </a> --}}
                            <h2 style="margin:0 0 20px 0;">E-Arsip BRMP Mektan</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Halo!</p>
                            <p>Anda menerima email ini karena ada permintaan reset password untuk akun Anda.</p>

                            <!-- Button Reset Password -->
                            <p style="text-align:center; margin:30px 0;">
                                <a href="{{ $url }}" style="
                                    display:inline-block;
                                    padding:12px 25px;
                                    background-color:#3490dc;
                                    color:#ffffff !important;
                                    text-decoration:none;
                                    border-radius:5px;
                                    font-weight:bold;
                                    font-size:16px;
                                ">Reset Password</a>
                            </p>

                            <p>Link reset password ini akan kedaluwarsa dalam <strong>60 menit</strong>.</p>
                            <p>Jika Anda tidak meminta reset password, tidak perlu melakukan tindakan apapun.</p>
                            <p>Salam,<br>E-Arsip BRMP Mektan</p>

                            <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

                            <p style="font-size:12px; color:#555;">
                                Jika tombol "Reset Password" tidak bisa diklik, salin dan tempel URL di bawah ke browser Anda:
                            </p>
                            <p style="font-size:12px; color:#3490dc; word-break:break-all;">
                                <a href="{{ $url }}" style="color:#3490dc;">{{ $url }}</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size:12px; color:#999; padding-top:20px;">
                            &copy; {{ date('Y') }} E-Arsip BRMP Mektan. Semua hak dilindungi.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
