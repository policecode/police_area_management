@extends('layouts.frontend_v2')
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
    <section class="nav-page py-3">
        <div class="container sm:flex items-center justify-between">
            <h1 class="title font-bold xl:text-[1.5rem] text-[1.25rem] sm:mr-2 mb-2 sm:mb-0 text-center sm:text-left">
                {{ $author['name'] }}</h1>
            <ul
                class="tab-categories-title bg-[#128c7e] text-[13px] flex justify-between items-center rounded overflow-hidden text-white">
                <li><a href="javasciprt:void(0)" title="Thể loại" class="block p-2 rounded" modal-rs-target="modal_cate">Thể
                        loại</a></li>
                <li><a href="{{ route('client.full-story') }}l" title="Hoàn thành" class="block p-2 rounded">Hoàn thành</a>
                </li>
                <li><a href="{{ route('client.new-update') }}" title="Mới" class="block p-2 rounded">Truyện mới</a></li>
                <li><a href="{{ route('client.hot-story') }}" title="Truyện hay" class="block p-2 rounded">Truyện Hay</a>
                </li>
                <li><a href="{{ route('client.view-story') }}" title="Xem nhiều" class="block p-2 rounded">Xem nhiều</a>
                </li>
            </ul>
        </div>

    </section>

    <section class="same-author py-3 min-h-[79vh]">
        <div class="container">
            <div class="flex flex-wrap -mx-2">
                @foreach ($records as $item)
                    <div class="basis-1/2 md:basis-1/3 lg:basis-1/4 px-2">
                        <div
                            class="same-author__item text-center lg:p-4 p-2 h-full transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.1)]">
                            <div class="box-image max-w-[170px] mx-auto mb-3">
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}" class="img c-img pt-[138%] overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)" srcset="{{ $item['thumbnail'] }}">
                                        <img loading="lazy" src="{{ $item['thumbnail'] }}"alt="{{ $item['title'] }}"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <h3>
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}"
                                    class="title  mb-2 line-clamp-1 text-[#1061b3]">{{ ucwords($item['title']) }}</a>
                            </h3>
                            <a href="{{ route('client.author', ['author_slug' => $author['slug']]) }}"
                                title="{{ $author['name'] }}"
                                class="author text-[#26a8cb]">{{ ucwords($author['name']) }}</a>
                            <div class="categories line-clamp-1 text-center">
                                @foreach ($item['categories'] as $key => $cat)
                                    @if ($key + 1 == count($item['categories']))
                                        <a href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}"
                                            title="{{ $cat['name'] }}"
                                            class="text-[#18a263] lg:text-[0.875rem] italic">{{ $cat['name'] }}</a>
                                    @else
                                        <a href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}"
                                            title="{{ $cat['name'] }}"
                                            class="text-[#18a263] lg:text-[0.875rem] italic">{{ $cat['name'] }}, </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
@endsection

@section('scripts')
@endsection
