<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();

?>
<!DOCTYPE html>
<!-- saved from url=(0021)https://suustore.com/ -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $option->getOptionValue('fvn_content_bottom') }}">
    <meta name="keywords" content="truyện hay, tiên hiệp, huyền huyễn, khoa huyễn, đô thị, võng du" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="author" content="" />
    <link rel="canonical" href="{{ url()->current() }}">
    {{-- Xác minh google để chèn quảng cáo --}}
    <meta name="google-adsense-account" content="ca-pub-8382233036922182">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon"
        href="{{ $option->getOptionImage('fvn_shortcut_icon') ? $option->getOptionImage('fvn_shortcut_icon') : asset('frontend/images/book_512x512_35977.ico') }}"
        type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    <script src="{{ asset('assets/js/jQuery3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/routeapi.js') }}"></script>
    <script>
        var FVN_LARAVEL_HOME = '{{ route('index') }}';
    </script>
</head>

<body>

    @include('parts.client.sidebar')

    @yield('content')

    @include('parts.client.footer')
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/boostrap.min.js') }}"></script>

    @yield('scripts')

</body>

</html>
