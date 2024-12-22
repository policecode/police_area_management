<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
?>
<section class="pt-3 pb-1 section-intro__index">
    <div class="container">
        <div class="flex flex-wrap -mx-1">
            {{-- <div class="hidden px-1 lg:block basis-1/4">
                <div class="box h-full pt-4 px-4 pb-0 shadow-[1px_1px_9px_rgba(0,0,0,.44)]">
                    <div class="flex flex-wrap -mx-2 tab-shortcut">
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="truyen-yeu-thich.html" title="Yêu thích"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{ asset('assets/uploads/demo/thumbs/350x0/top-yeuthich-end.png')}}">
                                    <img loading="auto" src="{{ asset('assets/uploads/demo/thumbs/350x0/top-yeuthich-end.png')}}" alt="Yêu thích" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="top-linh-phieu-tuan.html" title="Top Linh Phiếu"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{ asset('assets/uploads/demo/thumbs/350x0/top-linhphieu-end.png')}}">
                                    <img loading="auto" src="{{asset('assets/uploads/demo/thumbs/350x0/top-linhphieu-end.png')}}"
                                        alt="Top Linh Phiếu" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="tags/doc-quyen.html" title="Độc quyền"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{asset('assets/uploads/demo/thumbs/350x0/top-docquyen-end.png')}}">
                                    <img loading="auto" src="{{asset('assets/uploads/demo/thumbs/350x0/top-docquyen-end.png')}}" alt="Độc quyền" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="truyen-thinh-hanh-trong-tuan.html" title="Thịnh hành tuần"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{asset('assets/uploads/demo/thumbs/350x0/top-thinhhanh-end.png')}}">
                                    <img loading="auto" src="{{asset('assets/uploads/demo/thumbs/350x0/top-thinhhanh-end.png')}}" alt="Thịnh hành tuần" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="truyen-hot.html" title="Truyện hot"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{asset('assets/uploads/demo/thumbs/350x0/top-truyenhot-end.png')}}">
                                    <img loading="auto" src="{{asset('assets/uploads/demo/thumbs/350x0/top-truyenhot-end.png')}}"  alt="Truyện hot" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                        <div
                            class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                            <a href="tags/tac-dai-than.html" title="Tác đại thần"
                                class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                <picture>
                                    <source media="(min-width:0px)"
                                        srcset="{{asset('assets/uploads/demo/thumbs/350x0/top-chatluong-end.png')}}">
                                    <img loading="auto" src="{{asset('assets/uploads/demo/thumbs/350x0/top-chatluong-end.png')}}" alt="Tác đại thần" class="img-fluid">
                                </picture>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="px-1 basis-full w-full lg-w-50 lg:basis-2/4">
                <div class="swiper-container slide-cate__main">
                    <div class="swiper-wrapper">
                        @foreach ($hot_stories as $key => $item)
                            @if ($key > 5)
                                @break
                            @else
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
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container slide-cate__thumbs">
                    <div class="swiper-wrapper">
                        @foreach ($hot_stories as $key => $item)
                            @if ($key > 5)
                                @break
                            @else
                                <div class="swiper-slide h-auto">
                                    <div class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">{{'0'.($key + 1)}}</div>
                                </div>
                            @endif
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