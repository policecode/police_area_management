@extends('layouts.client')
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
                "name": "Truyện Full Việt",
                "url": "{{ route('index') }}"
              }]
          }
    </script>
@endsection
@section('content')
    <main>
        @include('client_page.part_home.story_hot')
        @include('client_page.part_home.story_new')
        @include('client_page.part_home.story_full')
    </main>
@endsection

@section('scripts')
@endsection
