<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kích hoạt tài khoản</title>
    <style>
        /* CSS CHUNG */
        body {
            background-color: #f0e6d6;
            font-family: Georgia, serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .book-container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;

            /* HIỆU ỨNG SÁCH */
            background-color: #fffaf0;
            border: 1px solid #c2b280;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15),
                0 0 0 10px #fdf7ee;
            padding: 30px;
            border-radius: 4px;
        }

        .logo-section {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #c2b280;
            /* Đường kẻ phân cách Logo và Nội dung */
        }

        .logo-placeholder {
            /* Vị trí để đặt Logo */
            width: 100px;
            /* Điều chỉnh kích thước Logo của bạn */
            height: 100px;
            /* Điều chỉnh kích thước Logo của bạn */
            margin: 0 auto;
            background-color: #c2b280;
            /* Màu nền tạm thời cho Logo */
            line-height: 100px;
            /* Căn giữa chữ (nếu dùng chữ) */
            color: #5d4037;
            font-weight: bold;
            font-size: 14px;
            display: block;
            /* Quan trọng để logo chiếm 1 khối */
            text-decoration: none;
            /* Nếu Logo là ảnh: thay thế background-color và line-height bằng thẻ <img> */
        }

        .chapter-title {
            font-size: 24px;
            color: #5d4037;
            text-align: center;
            border-bottom: 2px solid #c2b280;
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .content {
            color: #333333;
            font-size: 16px;
        }

        .content p {
            text-indent: 1.5em;
            margin-bottom: 1em;
        }

        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            background-color: #5d4037;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .signature {
            text-align: right;
            margin-top: 40px;
            font-style: italic;
            color: #777;
            border-top: 1px dashed #c2b280;
            padding-top: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="book-container">

        <div class="logo-section">
            <a href="{{env('APP_URL')}}" style="display: block; text-align: center;">
                <img src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}" alt="{{env('APP_URL')}}"
                    style="max-width: 150px; height: auto; border: 0;">
            </a>
        </div>

        <div class="chapter-title">
            Chương I: Thư Kích Hoạt Tài Khoản Mới
        </div>

        <div class="content">
            <p>Kính gửi: {{$user->name}},</p>
            <p>Chúng tôi vô cùng cảm ơn sự quan tâm của bạn và rất vui mừng chào đón bạn đến với cộng đồng đọc truyện của chúng
                tôi. Việc đăng ký tài khoản của bạn đã được ghi nhận.</p>
            <p>Để hoàn tất quá trình và bắt đầu hành trình khám phá, bạn vui lòng dành một chút thời gian để xác nhận
                địa chỉ email của mình thông qua liên kết dưới đây:</p>

            <div class="button-wrapper">
                <a href="{{route('verification.verify', ['remember_token' => $token])}}" class="button">
                    XÁC NHẬN TÀI KHOẢN NGAY
                </a>
            </div>

            <p>Thông tin cơ bản về tài khoản của bạn:</p>
            <ul style="list-style-type: none; padding-left: 20px;">
                <li>**Email:** <strong>{{$user->email}}</strong></li>
                <li>**Ngày tạo:** {{$user->created_at}}</li>
            </ul>

            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua thư này. Việc xác nhận giúp chúng tôi bảo vệ tài
                khoản của bạn khỏi bị truy cập trái phép.</p>
        </div>

        <div class="signature">
            Trân trọng,<br>
            {{env('APP_NAME')}} Team
        </div>
    </div>
</body>

</html>
