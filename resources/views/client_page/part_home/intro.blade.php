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
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    title="{{ $item['title'] }}" class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="auto" src="{{ $item['thumbnail'] }}" class="img-fluid"
                                            style="object-fit: contain;">
                                    </picture>
                                    <h3
                                        class="flex items-center justify-center py-2 hover:text-[#252525] absolute left-0 right-0 bottom-0 z-[100] bg-[#fff]">
                                        <span class="title inline-block">{{ ucwords($item['title']) }}</span>
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
                                    <div
                                        class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                        {{ $key + 1 }}</div>
                                @else
                                    <div
                                        class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                        {{ '0' . ($key + 1) }}</div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="px-1 basis-full lg:basis-2/4">
                <div
                    class="card-info h-full flex flex-col borer border-solid border-[#ebebeb] shadow-[0_1px_3px_rgba(0,0,0,.2)] rounded-[4px] bg-white overflow-hidden">
                    <p
                        class="head text-center py-2 px-5 text-[#128c7e] font-bold border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        Giới thiệu</p>
                    <div class="content bg-[#f8f9fa] p-4 flex-1">
                        <div class="mb-4 s-content content-card-info">
                            {!! $option->getOptionValue('fvn_content_bottom') !!}

                            {{-- <ul class="mt-4">
                                <li>
                                    <a href="" title="Thông báo - Hướng dẫn">Thông báo -
                                        Hướng dẫn</a>
                                </li>
                            </ul> --}}
                        </div>
                        <div class="flex flex-row mb-4 -mx-1">
                            @if ($option->getOptionValue('fvn_facebook_link'))
                                <a href="{{ $option->getOptionValue('fvn_facebook_link') }}" title="Nhóm Facebook "
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold text-[#007bff]">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            @endif
                            @if ($option->getOptionValue('fvn_tiktok_link'))
                                <a href="{{ $option->getOptionValue('fvn_tiktok_link') }}" title="Nhóm Tiktok "
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold text-[#373941]">
                                    <i class="fa-brands fa-tiktok"></i>
                                    
                                </a>
                            @endif
                            @if ($option->getOptionValue('fvn_telegram_link'))
                                <a href="{{ $option->getOptionValue('fvn_telegram_link') }}" title="Nhóm Telegram"
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold">
                                    <i class="fa-brands fa-telegram"></i>
                                    
                                </a>
                            @endif
                            @if ($option->getOptionValue('fvn_twitter_link'))
                                <a href="{{ $option->getOptionValue('fvn_twitter_link') }}" title="Nhóm Twitter "
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold text-[#26a8cb]">
                                    <i class="fa-brands fa-twitter"></i>
                                    
                                </a>
                            @endif
                            @if ($option->getOptionValue('fvn_discord_link'))
                                <a href="{{ $option->getOptionValue('fvn_discord_link') }}" title="Nhóm Discord "
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold text-[#4497f8]">
                                    <i class="fa-brands fa-discord"></i>
                                    
                                </a>
                            @endif
                            @if ($option->getOptionValue('fvn_instagram_link'))
                                <a href="{{ $option->getOptionValue('fvn_instagram_link') }}" title="Nhóm Instagram "
                                    class="title line-clamp-1 my-1 text-[1.5rem] mr-4 font-bold text-[#007bff]">
                                    <i class="fa-brands text-[#d31f1f]"></i>
                                    
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
