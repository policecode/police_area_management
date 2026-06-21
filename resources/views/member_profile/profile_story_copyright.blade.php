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

                @include('member_profile.parts.profile_story_nav')

                <div class="flex flex-wrap -mx-2">
                    @foreach ($records as $item)
                        @if (!empty($item['story_slug']))
                            <div class="basis-full md:basis-1/2 px-2 mb-4 item-favotite-story-{{ $item['story_id'] }}">
                                <div
                                    class="card-readed rounded h-full p-4 pr-8 bg-white shadow-[2px_2px_9px_rgba(0,0,0,.14)] relative">
                                    <div class="block mr-2">
                                        <a href="{{ route('client.story', ['story_slug' => $item['story_slug']]) }}"
                                            title="{{ $item['story_title'] }}"
                                            class="name font-bold lg:text-[1.25rem] text-[1rem] text-[#222222] block mb-1">
                                            {{ ucwords($item['story_title']) }}
                                        </a>
                                    </div>
                                    <div class="my-1">
                                        <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                            class="text-[0.8125rem] text-[#999] inline-block mr-4">{{ ucwords($item['author_name']) }}</a>
                                        @if ($item['is_convert'])
                                            <span class="text-[#128c7e]">[Convert]</span>
                                        @else
                                            <span class="inline-block text-[0.875rem]" style="color: #0000ff">[Dịch]</span>
                                        @endif
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        {{-- <span class="text-[#dc3545] mr-2">{{ $item['total_percentage'] }} sao</span> --}}
                                        <span class="text-[#28a745] mr-2">{{ $item['total_chapter'] }} chương</span>
                                        <span class="text-[#007bff]">{{ $item['view_count'] }} đọc</span>
                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                @include('parts.template.paging_client_v1')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
