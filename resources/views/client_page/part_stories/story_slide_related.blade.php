 <div class="swiper-container slide-story__related mb-3">
     <div class="swiper-wrapper">
         @foreach ($related_stories as $item)
             <div class="swiper-slide">
                 <div class="card-story max-w-[300px]">
                     <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" title="{{ $item['title'] }}"
                         class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
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
                     <h3>
                         <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" title="{{ $item['title'] }}"
                             class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                             {{ ucwords($item['title']) }}
                         </a>
                     </h3>
                     <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}" title="Thần Đông"
                         class="cate lg:text-[0.875rem]">
                         {{ ucwords($item['author_name']) }}
                     </a>
                 </div>
             </div>
         @endforeach
     </div>
     <div
         class="swiper-button swiper-prev related-prev flex items-center justify-center absolute top-[40%] left-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
         <i class="fa-solid fa-chevron-left"></i>
     </div>
     <div
         class="swiper-button swiper-next related-next flex items-center justify-center absolute top-[40%] right-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
         <i class="fa-solid fa-chevron-right"></i>
     </div>
 </div>
