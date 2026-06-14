@extends('layouts.frontend_v2')
<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>
@section('head')
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all">
    <script type="application/ld+json"> 
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $page_title }}",
            "image": [
                "{{ $story['thumbnail'] }}" 
             ],
            "datePublished":  "{{ dateFormat($story['created_at'], 'd/m/Y') }}" ,
            "dateModified":  "{{ dateFormat($story['updated_at'], 'd/m/Y') }}" ,
            "author": [{
                "@type": "Person",
                "name": "{{ $story['author_name'] }}",
                "url": "{{ route('client.author', ['author_slug' => $story['author_slug']]) }}"
              }]
          }
    </script>
    <link href="{{ asset('assets/tech5scomment/theme/css/commentaf78.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/css/audio-styles.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    <section class="section-story__detail py-2">
        <div class="container">
            @include('client_page.part_stories_audio.story_header')
            

            <div class="flex flex-wrap -mx-2 ">
                <div class="basis-full w-full xl-w-75 xl:basis-3/4 px-2 mb-3 xl:mb-0">
                    @include('client_page.part_stories_audio.story_list_chapter')

                    @include('client_page.part_stories.story_comment')
                    
                </div>
                @include('client_page.part_stories.story_same_author')
            </div>
        </div>
    </section>

    

@endsection


@section('scripts')
    <script src="{{ asset('assets/tech5s_js/tech5s_base.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    <script src="{{ asset('assets/tech5s_js/libraries/Techb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    <script src="{{ asset('assets/js/slider42bb.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    {{-- Logic Audio Player Ä‘Ă£ Ä‘Æ°á»£c gá»™p vĂ o appListChapterStory trong story_list_chapter.blade.php --}}
@endsection
