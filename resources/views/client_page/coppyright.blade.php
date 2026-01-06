@extends('layouts.frontend_v2')
<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>
@section('head')
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all">
    <link href="{{ asset('assets/tech5scomment/theme/css/commentaf78.css?v=' . FVN_VERSION_LARAVEL) }}" type="text/css"
        rel="stylesheet" />
@endsection
@section('content')
    <section class="section-story__detail py-2">
        <div class="container">
            <div class="box p-2 rounded-lg border border-solid border-[#ddd] bg-[#ffffff] mb-4">
                <h1 class="name-story font-bold 2xl:text-[1.75rem] lg:text-[1.5rem] text-[1.25rem] mb-2">Truyện này đang được bảo vệ bản quyền, trang web không cung cấp và chia sẻ nội dung</h1>
                <p>Tên truyện: {{ $story['title'] }}</p>
                <p>Thông tin tác giả: {{ $story['author_name'] }}</p>
                <p>Giới thiệu truyện: {!! $story['description'] !!}</p>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/tech5s_js/tech5s_base.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript"
        defer></script>
    <script src="{{ asset('assets/tech5s_js/libraries/Techb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript"
        defer></script>

    <script src="{{ asset('assets/js/swiper-bundle.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer>
    </script>
    <script src="{{ asset('assets/js/slider42bb.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
@endsection
