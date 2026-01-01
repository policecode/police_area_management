@extends('layouts.frontend_v2')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <section class="person-info-page py-6 min-h-[85vh]">
        <div class="container">
            <div class="module-info-page rounded shadow-[0_8px_16px_rgba(0,0,0,.15)] bg-white overflow-hidden">
                @include('member_profile.parts.profile_logo')
                <div id="member_profile_app" class="p-5">
                    @include('member_profile.parts.profile_nav')
                    <p class="font-bold text-[1.25rem] mb-4 text-[rgba(0,0,0,0.8)]">Bình luận</p>
                    <div class="list-comment">
                        @foreach ($records as $item)
                            <div
                                class="comment-item md:p-4 p-2 rounded-md bg-white border border-solid border-[#ddd] md:mb-6 mb-4 last:mb-0">
                                <h3 class="content font-bold text-[1.25rem] line-clamp-4 mb-3">
                                    <i class="fa-solid fa-quote-left"></i>
                                    {{ $item['content'] }}
                                </h3>
                                <p>
                                    <span>Truyện</span>
                                    <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="link">{{ $item['title'] }}</a>
                                </p>
                                <p><span class="mr-4">Like: {{ $item['like'] }}</span></p>
                                <p><span>Thời gian:</span> {{ dateFormat($item['created_at']) }}</p>
                            </div>
                            
                        @endforeach
                        @include('parts.template.paging_client_v1')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
