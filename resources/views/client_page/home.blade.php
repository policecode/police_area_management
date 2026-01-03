@extends('layouts.frontend')
@section('head')
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all">
    <script type="application/ld+json"> 
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $page_title }}",
            "image": [
             ],
            "author": [{
                "@type": "Person",
                "name": "Hăc Hoàng Đại Đế",
                "url": "{{ route('index') }}"
              }]
          }
    </script>
@endsection
@section('content')
    @include('client_page.part_home.intro')
    @include('client_page.part_home.pro-cate')
    @include('client_page.part_home.top-story')
    @include('client_page.part_home.ranking_v2')
    @include('client_page.part_home.authorvn')
    {{-- @include('client_page.part_home.just-finished') --}}
    {{-- @include('client_page.part_home.new-story') --}}
@endsection

@section('scripts')
<script src="{{ asset('assets/tech5s_js/tech5s_base.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/tech5s_js/libraries/Techb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
{{-- Slider --}}
<script src="{{ asset('assets/js/swiper-bundle.minb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/js/slider42bb.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
@endsection
