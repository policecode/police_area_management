<section class="py-1">
    <div class="container">
        <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
            <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Bình luận mới nhất</h2>
            {{-- <a href="{{ route('client.tag', ['tag_slug' => 'va-mat']) }}" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem]">Tất cả
                <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
        </div>
        <div
            class="flex flex-nowrap whitespace-nowrap md:whitespace-normal overflow-x-auto md:overflow-x-visible md:flex-wrap -mx-1">
            @foreach ($last_comments as $item)
                <div class="basis-[70%] md:basis-1/3 w-[100%] px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <div class="content novel-item w-[100%]">
                             <h4 class="flex xl:text-[1rem] text-[0.75rem]">
                                @if ($item['user_id'])
                                    <a href="{{ route('member.profile', ['user_id' => $item['user_id']]) }}"
                                        title="{{ $item['name'] }}"
                                        class="title font-bold line-clamp-1 mb-2 text-[#d31f1f]">{{ $item['name'] }}</a>
                                @endif
                                <span class="ml-2">đã bình luận công pháp</span>
                            </h4>
                            <h3>
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] text-[#007bff] line-clamp-1 mb-2">{{ ucwords($item['title']) }}</a>
                            </h3>
                          
                            <div title="{{$item['content']}}" class="text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4 s-content mb-2">{{ $item['content'] }}</div>
                            <span class="item-time">{{ get_string_after_time($item['after_minutes']) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
