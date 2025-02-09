<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
?>
<section class="pt-3 pb-1 section-intro__index">
    <div class="container">
        <div class="flex flex-wrap -mx-1">
         
            <div class="px-1 basis-full w-full lg-w-50 lg:basis-2/4">
                <div class="swiper-container slide-cate__main">
                    <div class="swiper-wrapper">
                        @foreach ($hot_stories as $key => $item)
                                <div class="swiper-slide">
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" title="{{$item['title']}}"
                                        class="link block c-img pt-[50%]">
                                        <picture>
                                            <img loading="auto" src="{{$item['thumbnail']}}" class="img-fluid" style="object-fit: contain;">
                                        </picture>
                                        <h3 class="flex items-center justify-center py-2 hover:text-[#252525] absolute left-0 right-0 bottom-0 z-[100] bg-[#fff]">
                                            <span class="title inline-block">{{ucwords($item['title'])}}</span>
                                        </h3>
                                    </a>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container slide-cate__thumbs">
                    <div class="swiper-wrapper">
                        @foreach ($hot_stories as $key => $item)
                                <div class="swiper-slide h-auto">
                                    @if ($key > 8)
                                        <div class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">{{($key + 1)}}</div>
                                    @else
                                        <div class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">{{'0'.($key + 1)}}</div>
                                    @endif
                                </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="px-1 basis-full lg:basis-2/4">
                <div
                    class="card-info h-full flex flex-col borer border-solid border-[#ebebeb] shadow-[0_1px_3px_rgba(0,0,0,.2)] rounded-[4px] bg-white overflow-hidden">
                    <p class="head text-center py-2 px-5 text-[#128c7e] font-bold border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">Giới thiệu</p>
                    <div class="content bg-[#f8f9fa] p-4 flex-1">
                        <div class="mb-4 s-content content-card-info">
                            {!!$option->getOptionValue('fvn_content_bottom')!!}
                            {{-- <ul>
                                <li>
                                    <a href="{{route('client.huongdan')}}" title="Thông báo - Hướng dẫn">Thông báo -
                                        Hướng dẫn</a>
                                </li>
                            </ul> --}}
                        </div>
                        <div class="flex flex-row mb-4 -mx-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>