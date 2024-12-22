<section class="py-1">
    <div class="container">
        <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
            <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Đã Hoàn Thành</h2>
            <a href="{{ route('client.full-story') }}" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem]">Tất cả
                <i class="ml-2 fa-solid fa-right-long"></i></a>
        </div>
        <div
            class="flex flex-nowrap whitespace-nowrap md:whitespace-normal overflow-x-auto md:overflow-x-visible md:flex-wrap -mx-1">
            @foreach ($full_stories as $item)
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                            title="{{ $item['title'] }}s"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy" src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                    class="img-fluid">
                            </picture>
                            <span class="novel-stripe">
                                <span class="story-status">FULL</span>
                            </span>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">{{ ucwords($item['title']) }}</a>
                            </h3>
                            <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                title="{{ $item['author_name'] }}"
                                class="author text-[#6c757d] lg:text-[0.875rem]">{{ $item['author_name'] }}</a>
                            <div class="tag flex flex-wrap mt-2">
                                @foreach ($item['categories'] as $cat)
                                    <a href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}"
                                        title="{{ $cat['name'] }}"
                                        class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">{{ $cat['name'] }}</a>
                                @endforeach
                            </div>
                            <a href="{{ route('client.chaper', ['story_slug' => $item['slug'], 'chaper_slug' => $item['chaper_slug']]) }}" title="{{$item['chaper_name']}}" class="chapter-name text-[#128c7e] text-[0.875rem]">{{$item['chaper_name']}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
