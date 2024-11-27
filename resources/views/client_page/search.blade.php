@extends('layouts.client')
@section('head')
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
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 col-md-8 col-lg-9 mb-3">
                    <div class="head-title-global d-flex justify-content-between mb-2">
                        <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                            <h1 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                <span class="d-block text-decoration-none text-dark fs-4 category-name"
                                    title="{{$keyword}}">Tìm kiếm với từ khóa: {{$keyword}}</span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            @include('parts.ads.adsense_v1')
                        </div>
                        @foreach ($records as $item)
                            <div class="col-12 mb-3">
                                <div class="d-flex">
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" class="">
                                        <div class="position-relative">
                                            <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                                class="img-fluid border border-primary rounded" width="150"
                                                height="230" loading="lazy">
                                            <div class="position-absolute top-0 start-0 m-1">
                                                @if ($item['status'] == 1)
                                                    <span class="story-item__badge badge text-bg-success">Full</span>
                                                @endif
                                                @if ($item['star_average'] > 7)
                                                    <span
                                                        class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>
                                                @endif
                                                @if ($item['after_day'] < 30)
                                                    <span
                                                        class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content ms-2">
                                        <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" class="fs-4 text-dark text-capitalize fw-semibold text-decoration-none">
                                            <i class="fa-solid fa-book-open"></i>
                                            {{ $item['title'] }}
                                        </a>
                                        <div class="card-text">
                                            <i class="fa-solid fa-pencil"></i>
                                            {{$item['author_name']}}
                                        </div>
                                        <div class="card-text">
                                            <i class="fa-solid fa-list-ol"></i>
                                            {{$item['total_chapers']}} Chương
                                        </div>
                                        <div class="card-text">
                                            <i class="fa-regular fa-clock"></i>
                                            <i>{{get_string_after_time($item['last_update'])}}</i>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    @include('parts.template.paging_client')
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    @include('client_page.part_stories.story_top_ratings', [])
                    @include('client_page.part_stories.table_categories', [])
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
@endsection
