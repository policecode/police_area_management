@extends('layouts.frontend_v2')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    @include('client_page.part_tags.part_navbar_page')

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
                                        title="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
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
                                            <p
                                                class="text-[#28a745] mr-1 whitespace-nowrap">Tổng LT bán được: {{ $item['total_money'] }}
                                                LT</p>
                                            <p class="text-[#007bff] mr-1 whitespace-nowrap">Bán trong tháng: {{ $item['money'] }}
                                                LT</p>
                                            <p class="text-[#dc3545] mr-1 whitespace-nowrap">Số lượt xem: {{ $item['view_count'] }}</p>
                                            
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
                    'is_story' => true,
                ])
            </div>

        </div>

    </section>
@endsection


@section('scripts')
@endsection
