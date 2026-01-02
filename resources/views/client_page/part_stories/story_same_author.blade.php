 <div class="basis-full xl:basis-1/4 px-2">
     <div class="sidebar-story">
         @if (count($story_by_author))
             <div
                 class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                 <div
                     class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                     <p class="text-[0.938rem] font-bold">Truyện cùng tác giả</p>
                 </div>
                 <ul class="list-story__item">
                     @foreach ($story_by_author as $item)
                         <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                             <div class="flex items-center justify-between">
                                 <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                     class="w-[75%] line-clamp-1 text-[0.875rem]" title="{{ $item['title'] }}">
                                     @if ($item['is_convert'])
                                         <span class="prefix text-[#128c7e]">[Convert]</span>
                                     @else
                                         <span class="prefix text-[#128c7e]" style="color: #0000ff;">[Dịch]</span>
                                     @endif
                                     {{ ucwords($item['title']) }}
                                 </a>
                                 <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                     title="{{ $item['author_name'] }}"
                                     class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">
                                     {{ ucwords($item['author_name']) }}
                                 </a>
                             </div>
                             <p class="text-[12px] text-[#999999] mt-[2px]">views:
                                 {{ $item['view_count'] }}
                             </p>
                         </li>
                     @endforeach
                 </ul>
             </div>
         @endif

         @if (count($star_ratings))
             <div id="top-contributor-box">
                 <div
                     class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                     <div
                         class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                         <p class="text-[0.938rem] font-bold">Đánh giá gần nhất</p>
                     </div>
                     <ul class="list-story__item">
                         @foreach ($star_ratings as $item)
                             <li class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                @if ($item['user_id'])
                                    <a href="{{route('member.profile', ['user_id' => $item['user_id']])}}" title="{{ $item['name'] }}" class="w-[75%] text-[0.875rem] block">
                                        <span class="line-clamp-1 inline-block">{{ $item['name'] }} -</span>
                                        <span class="line-clamp-1 inline-block">{{ $item['point_star'] }} <i
                                                class="fa-solid fa-star text-[#ffd700]"></i></span>
                                    </a>
                                @else
                                    <a href="#" title="{{ $item['name'] }}" class="w-[75%] text-[0.875rem] block">
                                        <span class="line-clamp-1 inline-block">{{ $item['name'] }} -</span>
                                        <span class="line-clamp-1 inline-block">{{ $item['point_star'] }} <i
                                                class="fa-solid fa-star text-[#ffd700]"></i></span>
                                    </a>
                                @endif
                                 <span class="block text-[0.825rem] text-[#999] mt-1"> {{ $item['content'] }}</span>

                             </li>
                         @endforeach


                     </ul>
                 </div>
             </div>
         @endif

     </div>
 </div>
