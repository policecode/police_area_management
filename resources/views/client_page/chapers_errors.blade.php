<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

?>
@extends('layouts.frontend_v1')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/confirm.minb2fd.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/chapterdcb9.css?v=' . FVN_VERSION_LARAVEL) }}" type="text/css">
    <link rel="stylesheet"
        href="{{ asset('assets/tech5scomment/theme/css/emojionearea.minaf78.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/tech5scomment/theme/css/commentaf78.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css" />
@endsection
@section('content')
    <script>
        var redirectToStory = '{{ $story['link'] }}';
        var apiUrlChapter =
            '{{ route('client.api.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]) }}';
    </script>

    <div class="container chapter-page-apply" style="">
        <div
            class="lock flex justify-center my-2 relative before:absolute before:w-full before:h-[1px] before:bg-[#ccc] before:top-1/2 before:left-0 before:translate-y-1/2">
            <span
                class="lock-icon bg-white relative flex items-center justify-center w-9 h-9 rounded-full border border-solid border-[#ccc]"><i
                    class="fa-solid fa-lock"></i></span>
        </div>
        <div class="box-buy-chapter my-5">
            <p class="title text-center lg:text-[1.5rem] text-[1.25rem] font-bold mb-3">
                Trang web hiện tại chỉ cho phép đọc 100 chương đầu tiên của truyện. <br>
                Nếu bạn muốn tiếp tục đọc, vui lòng đăng nhập tài khoản, truyện của chúng tôi hoàn toàn miễn phí.
            </p>
            <div class="text-center">
                <a href="{{ route('member.form_login') }}" title="Đăng nhập"
                    class="btn btn-green !rounded mb-1 min-w-[200px] w-fit mx-auto">Đăng nhập</a>
            </div>
        </div>
     
        <div class="flex justify-between flex-wrap mt-6">
            <p class="text-[#128c7e]">
                Sưu Tầm, {{ dateFormat($chaper['created_at']) }}
            </p>
            <p class="text-[#128c7e]">Lượt xem: {{ $chaper['view'] }}</p>
        </div>
        <div class="box-control py-3 flex flex-wrap justify-center">
            <a href="{{ $link_prev }}" title="Chương trước"
                class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                <i class="fa-solid fa-angle-left mr-2"></i> Chương trước
            </a>
            <span
                class="btn show-chapter__list !rounded xl:py-2 xl:px-4 text-white bg-[#6c757d] mx-1 text-[1.25rem] cursor-pointer btn-show-list-chapter-page">
                <i class="fa-solid fa-table-list"></i>
            </span>
            <a href="{{ $link_next }}" title="Chương trước"
                class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                Chương tiếp <i class="fa-solid fa-angle-right ml-2"></i>
            </a>
            <div class="w-full">
                <div class="list-chapter-page"></div>
            </div>
        </div>
        <div class="text-center">
            <a href="javascript:void(0)" title="Báo lỗi chương"
                class="btn bg-[#f0ad4e] !text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2"
                modal-rs-target="modal-report" style="cursor: pointer;">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i>Báo lỗi chương
            </a>
        </div>
    </div>

    <div id="comment_block" class="container">
        @include('client_page.part_stories.story_comment')

    </div>

    {{-- Comment End --}}
@endsection

@section('scripts')
    @if (!$is_admin)
        <script src="{{ asset('assets_global/js/website_security.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
    @endif
@endsection
