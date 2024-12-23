<section class="py-1 just-finished">
    <div class="container">
        <div class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">Truyện Convert</h2>
                <a href="{{ route('client.tag', ['tag_slug' => 'convert']) }}" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem] ">
                    Tất cả <i class="ml-2 fa-solid fa-right-long"></i></a>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                @foreach ($convert_stories as $item)
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                        title="{{ $item['title'] }}" class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)" srcset="{{ $item['thumbnail'] }}">
                                            <img loading="lazy" src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="img-fluid">
                                        </picture> 
                                        @if ($item['status'] == 1)
                                            <span class="novel-stripe">
                                                <span class="story-status">FULL</span>
                                            </span>
                                        @endif
                                    </a>
                                    <div class="book__side"><span class="book__side__label">truyenfullviet.com</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                        title="{{ $item['title'] }}"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">{{ ucwords($item['title']) }}</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}" title="{{ $item['author_name'] }}" class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">{{ $item['author_name'] }}</a>
                                    @if ($item['is_convert'])
                                        <span class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded text-[#128c7e] border-[#128c7e]">Convert</span>
                                    @else
                                        <span class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded" style="color: #0000ff;border-color:#0000ff">Dịch</span>
                                    @endif
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    {{-- <span class="text-[#dc3545] mr-1 whitespace-nowrap">584.910 Chữ</span> --}}
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">{{$item['total_chapter']}} Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">{{$item['view_count']}} Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    {!!$item['description']!!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>