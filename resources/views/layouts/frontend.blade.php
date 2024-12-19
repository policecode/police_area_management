<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();

?>
<!DOCTYPE html>
<!-- saved from url=(0021)https://suustore.com/ -->
<html lang="en" itemtype="http://schema.org/WebPage" lang="vi">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base />
    <title>{{ $page_title }}</title>
    <meta name="description"
        content="{{ empty($description) ? $option->getOptionValue('fvn_content_top') : $description }}">
    <meta name="keywords"
        content="truyenfullviet, truyenfullviet.com, truyện hay, tiên hiệp, huyền huyễn, khoa huyễn, đô thị, võng du" />
    {{-- <meta property="og:site_name" content="Bàn Long">
    <meta property="og:url" content="index.html">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Truyện, tiểu thuyết hay, full dịch">
    <meta property="og:image" content="uploads/demo/logo-end.png">
    <meta property="og:locale" content="vi_vn">
    <meta property="fb:app_id" content=""> --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="shortcut icon"
        href="{{ $option->getOptionImage('fvn_shortcut_icon') ? $option->getOptionImage('fvn_shortcut_icon') : asset('frontend/images/book_512x512_35977.ico') }}"
        type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='revisit-after' content='1 days' />
    <meta http-equiv="content-language" content="vi" />
    <meta name="is-login" content="0">
    <meta name="current-lang" content="vi">
    <meta name="exchange-rate" content="1">
    {{-- <meta name="author" content="" /> --}}

    <link rel="preload" href="{{ asset('assets/fonts/Roboto-Regularb2fd.ttf?v='.FVN_VERSION_LARAVEL) }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Roboto-Boldb2fd.ttf?v='.FVN_VERSION_LARAVEL) }}" as="font" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/css/fontawesome-free-6.2.0-web/webfonts/fa-solid-900b2fd.woff2?v='.FVN_VERSION_LARAVEL) }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/css/fontawesome-free-6.2.0-web/webfonts/fa-brands-400b2fd.woff2?v='.FVN_VERSION_LARAVEL) }}"
        as="font" type="font/woff2" crossorigin="anonymous">

    <link href="{{ asset('assets/css/fontawesome-free-6.2.0-web/css/all.minb2fd.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/toastify.minbb07.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />

    <link href="{{ asset('assets/css/swiper-bundle.minb2fd.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />

    <link href="{{ asset('assets/css/output0841.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/main0841.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/appb0ac.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />

    {{-- <script src="{{ asset('assets_global/js/jQuery3.6.0.min.js') }}"></script> --}}
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js?v='.FVN_VERSION_LARAVEL) }}"></script>
    <script>
        var typeNotify = "";
        var messageNotify = "";
        var nx_user_id = "";
        var FVN_LARAVEL_HOME = '{{ route('index') }}';
    </script>
    {{-- <link href="manifest.webmanifest" rel="manifest" /> --}}

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382233036922182"
        crossorigin="anonymous"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5T1TVNVMFY"></script>
    {{-- Xác minh google để chèn quảng cáo --}}
    <meta name="google-adsense-account" content="ca-pub-8382233036922182">
    {{-- Google analytic --}}
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-5T1TVNVMFY');
    </script>
    {{-- Thêm các thành phần bổ sung --}}
    @yield('head')
</head>

<body
    class="wrapper mx-auto 2xl:text-[16px] text-[14px] text-[#252525] leading-snug font-['Roboto',sans-serif] overflow-x-hidden"
    style="background-image: url({{ asset('assets/uploads/demo/background-min.jpg') }});">

    @include('parts.client.sidebar_v1')

    @yield('content')

    @include('parts.client.footer_v1')

    {{-- <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0&appId=8969948979690020"></script> --}}
    {{-- @include('parts.ads.adsense_social') --}}
    @yield('scripts')
</body>

</html>
