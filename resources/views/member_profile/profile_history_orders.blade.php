@extends('layouts.profile')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <div class="main-content py-2 ">
        <div class="my-2 shadow-[0_0_1px_rgba(0,0,0,.13)] min-h-[83vh]">
            <div class="px-4">
                @include('member_profile.parts.profile_breadcrumb')

                <div class="flex flex-wrap -mx-2">
                    @foreach ($records as $item)
                        <div class="basis-full md:basis-1/2 px-2 mb-4 item-user-story-history">
                            <div class="card-readed rounded h-full flex justify-between p-4 pr-8 bg-white shadow-[2px_2px_9px_rgba(0,0,0,.14)] relative">
                                <div class="block mr-2">
                                    <a href="{{ route('client.story', ['story_slug' => $item['story_slug']]) }}" title="{{ $item['story_title'] }}" class="name font-bold block mb-1">
                                        @if ($item['is_convert'])
                                            <span class="text-[#128c7e]">[Convert]</span>
                                        @else
                                            <span class="text-[#128c7e]" style="color: #0000ff;">[Dịch]</span>
                                        @endif
                                        {{ ucwords($item['story_title']) }}
                                    </a>
                                    @if ($item['chapter_position'])
                                        <p class="flex">
                                            <span class="mr-2">Chương đã mua:</span>
                                            <a href="{{ route('client.chaper', ['story_slug' => $item['story_slug'], 'chaper_position' => $item['chapter_position']]) }}" class="text-[0.875rem] text-[#007bff] block">{{ ucwords($item['chapter_title']) }}</a>
                                        </p>
                                    @endif
                                    <p class="flex">
                                        <span class="mr-2">Giá cả:</span>
                                        <span class="text-[0.875rem] text-[#d31f1f] block ">{{ $item['money'] }} LT</span>
                                    </p>
                                    <p class="flex">
                                        <span class="mr-2">Thời gian mua:</span>
                                        <span class="text-[0.875rem] text-[#28a745] block">{{ dateFormat($item['created_at'], 'H:i:s d-m-Y') }}</span>
                                    </p>
                                </div>
                            
                            </div>
                        </div>
                        
                    @endforeach
       
                </div>
                @include('parts.template.paging_client_v1')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
