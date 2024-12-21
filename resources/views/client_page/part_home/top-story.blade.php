<section class="py-1 top-story">
    <div class="container">
        <div class="flex flex-wrap -mx-2">
            <div class="px-2 basis-full xl:basis-1/4 order-last xl:order-first">
                <div class="sidebar-story mb-5">
                    <div
                        class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                        <div
                            class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            <p class="text-[0.938rem] font-bold mr-2">Truyện mới nhất</p>
                            <a href="{{ route('client.new-update') }}" title="Danh sách đầy đủ"
                                class="view-more text-[1.3] text-[#128c7e]">
                                <i class="fa-solid fa-right-long"></i>
                            </a>
                        </div>
                        <ul class="list-story__item">
                            @foreach ($new_stories as $item)
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]" title="{{ $item['title'] }}">
                                            @if ($item['is_convert'])
                                                <span class="prefix text-[#128c7e]">[Convert]</span>
                                            @else
                                                <span class="prefix" style="color: #0000ff">[Dịch]</span>
                                            @endif
                                            {{ ucwords($item['title']) }}
                                        </a>
                                        <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                            title="{{ $item['author_name'] }}"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">{{ $item['author_name'] }}</a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="sidebar-story mb-5">
                    <div
                        class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                        <div
                            class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            <p class="text-[0.938rem] font-bold mr-2">Chương mới cập nhật</p>
                            <a href="{{ route('client.new-update') }}" title="Danh sách đầy đủ"
                                class="view-more text-[1.3] text-[#128c7e]">
                                <i class="fa-solid fa-right-long"></i>
                            </a>
                        </div>
                        <ul class="list-story__item">
                            @foreach ($new_chapters as $item)
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                            class=" line-clamp-1 text-[0.875rem]" title="{{ $item['title'] }}">
                                            @if ($item['is_convert'])
                                                <span class="prefix text-[#128c7e]">[Convert]</span>
                                            @else
                                                <span class="prefix" style="color: #0000ff">[Dịch]</span>
                                            @endif
                                            {{ ucwords($item['title']) }}

                                        </a>
                                        <a href="{{ route('client.chaper', ['story_slug' => $item['slug'], 'chaper_slug' => $item['chaper_slug']]) }}"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="{{ $item['chaper_name'] }}">{{ $item['chaper_name'] }}</a>
                                    </div>
                                    <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                        title="{{ $item['author_name'] }}"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">{{ $item['author_name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="px-2 basis-full xl:basis-3/4 mb-5">
                <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
                    <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Truyện Hot</h2>
                    <a href="{{ route('client.full-story') }}" title="Tất cả"
                        class="readmore text-[#128c7e] text-[0.875rem] ">Tất cả
                        <i class="ml-2 fa-solid fa-right-long"></i>
                    </a>
                </div>
                <div class="flex flex-wrap -mx-1">
                    @foreach ($hot_stories as $item)
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)" srcset="{{ $item['thumbnail'] }}">
                                        <img loading="lazy" src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                            class="img-fluid">
                                    </picture>
                                    <span class="novel-stripe">
                                        @if ($item['status'] == 1)
                                            <span class="story-status">FULL</span>
                                        @endif
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                            title="{{ $item['title'] }}"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">
                                            {{ ucwords($item['title']) }}</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                            title="{{ $item['author_name'] }}"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">
                                            {{ $item['author_name'] }}
                                        </a>
                                        @if ($item['is_convert'])
                                            <span title="Convert" class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded text-[#128c7e]">Convert</span>
                                        @else
                                            <span title="Dịch" class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded" style="color: #0000ff;border-color:#0000ff">Dịch</span>
                                        @endif
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        {{-- <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.832.393 Chữ</span> --}}
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">{{ $item['total_chapter'] }} Chương</span>
                                        {{-- <span class="text-[#007bff] mr-1 whitespace-nowrap">13 Đề cử/tuần</span> --}}
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        {!! $item['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
