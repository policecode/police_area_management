@extends('layouts.frontend_v2')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <section class="nav-page py-3">

        <div class="container sm:flex items-center justify-between">

            <h1 class="title font-bold xl:text-[1.5rem] text-[1.25rem] sm:mr-2 mb-2 sm:mb-0 text-center sm:text-left">{{ $breadcrumb[1]['title'] }}</h1>

            <ul
                class="tab-categories-title bg-[#128c7e] text-[13px] flex justify-between items-center rounded overflow-hidden text-white">
                <li><a href="javasciprt:void(0)" title="Thể loại" class="block p-2 rounded" modal-rs-target="modal_cate">Thể loại</a></li>
                <li><a href="{{route('client.full-story')}}l" title="Hoàn thành" class="block p-2 rounded">Hoàn thành</a></li>
                <li><a href="{{route('client.new-update')}}" title="Mới" class="block p-2 rounded">Truyện mới</a></li>
                <li><a href="{{route('client.hot-story')}}" title="Truyện hay" class="block p-2 rounded">Truyện Hay</a></li>
                <li><a href="{{route('client.view-story')}}" title="Xem nhiều" class="block p-2 rounded">Xem nhiều</a></li>
            </ul>
        </div>

    </section>
    <section class="section-cate py-3 min-h-[79vh]">
        <div class="container">
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 basis-full xl:basis-3/4 xl:order-2">
                    <div class="flex flex-wrap -mx-1">
                        @foreach ($records as $item)
                            <div class="px-1 basis-1/2 mb-2">
                                <div
                                    class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                        title="truyen/phu-luc-ta-ve-deu-bi-cam-dung"
                                        class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                        <picture>
                                            <source media="(min-width:0px)" srcset="{{ $item['thumbnail'] }}">
                                            <img loading="lazy" src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                                class="img-fluid">
                                        </picture>
                                        @if ($item['status'] == 1)
                                            <span class="novel-stripe">
                                                <span class="story-status">FULL</span>
                                            </span>
                                        @endif
                                    </a>
                                    <div class="flex-1 content">
                                        <h3>
                                            <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                                title="{{ $item['title'] }}"
                                                class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">{{ ucwords($item['title']) }}</a>
                                        </h3>
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                                title="{{ $item['author_name'] }}"
                                                class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">{{ ucwords($item['author_name']) }}</a>
                                            @if ($item['is_convert'])
                                                <span title="Convert"
                                                    class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded text-[#128c7e] border-[#128c7e]">Convert</span>
                                            @else
                                                <span title="Dịch"
                                                    class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                                    style="color: #0000ff;border-color:#0000ff">Dịch</span>
                                            @endif

                                        </div>
                                        <div class="story-info lg:text-[0.875rem]">
                                            {{-- <span class="text-[#dc3545] mr-1 whitespace-nowrap">584.910 Chữ</span> --}}
                                            <span class="text-[#28a745] mr-1 whitespace-nowrap">{{$item['total_chapter']}} Chương</span>
                                            <span class="text-[#007bff] mr-1 whitespace-nowrap">{{$item['view_count']}} Đọc</span>
                                        </div>
                                        <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                            {!! $item['description'] !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @include('parts.template.paging_client_v1')
                </div>
                @include('client_page.part_tags.new_stories_v1', [
                    'is_chapter' => true,
                    'is_story' => true
                ])
            </div>

        </div>

    </section>
@endsection

@section('scripts')
@endsection
