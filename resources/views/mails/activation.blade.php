<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kích hoạt tài khoản</title>
    <style>
        /* CSS nội tuyến cơ bản cho email */
        body { font-family: 'Nunito', sans-serif; }
        /* Các style khác cho khả năng hiển thị trên nhiều ứng dụng */
        .wrapper { background-color: #f2f4f6; width: 100%; margin: 0; padding: 0; }
        .content { width: 100%; max-width: 570px; margin: 0 auto; padding: 0; }
        .header { padding: 25px 0; text-align: center; }
        .body { background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; }
        .footer { padding: 25px 0; text-align: center; }
        .button { background-color: #3869d4; border-radius: 3px; color: #ffffff; display: inline-block; text-decoration: none; }
        .button:hover { background-color: #2955a8; }
        /* ... và nhiều CSS cụ thể khác ... */
    </style>
</head>
<body>
    <h1>{{$user->email}}</h1>
    <p>Tiến hành kích hoạt tài khoản</p>
    <p>Token: {{$token}}</p>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    @include('mail::header') {{-- Logo/Tên ứng dụng --}}

                    {{-- Body Email --}}
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                {{-- Nội dung email Markdown/HTML của bạn sẽ ở đây --}}
                                <tr>
                                    <td class="content-cell">
                                        {{ $slot }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @include('mail::footer') {{-- Bản quyền/Nút hủy đăng ký --}}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>