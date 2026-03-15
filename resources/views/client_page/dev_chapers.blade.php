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
    <div id="app_chapter">
        <section class="py-4 read-stories">
            <div class="container chapter-content-container chapter-page-apply">
                <div id="chapter-content_s" style="font-size:18px;line-height:24px;font-family:Roboto;">
                    <button class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2"
                        onclick="copyText()">Coppy Text</button>
                    <div id="myInput" class="s-content text-justify mt-4 published-content px-1">
                        {{$description}}
                        <br>
                        {{ $content }}
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function copyText() {
            // Lấy nội dung văn bản từ một phần tử (ví dụ: thẻ input hoặc span)
            const textToCopy = document.getElementById("myInput").innerText;

            // Sử dụng Clipboard API để viết vào bộ nhớ tạm
            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    alert("Copy thành công: " + textToCopy);
                });
            } else {
                // Cách dự phòng nếu trình duyệt cũ không hỗ trợ Clipboard API
                const textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("copy");
                document.body.removeChild(textArea);
                alert("Copy thành công!");
            }
        }
    </script>
@endsection
