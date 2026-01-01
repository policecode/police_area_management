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
                    <p class="font-bold text-[1.25rem] mb-4 text-[rgba(0,0,0,0.8)]">Lai lịch</p>
                    <ul class="list-info text-[0.875rem]">
                        <li class="mb-1">
                            <span class="font-bold">Danh tính:</span>
                            {{$user['name']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Tu vi:</span>
                            {{$user['level_info']['name']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Số công bộ pháp đã tu luyện:</span>
                            {{$user['total_story']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Chân nguyên:</span>
                            {{$user['exp']}}/{{$user['level_info']['next_exp']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Sinh thần:</span>
                            {{ dateFormat($user['date_of_birth'], 'd/m/Y') }}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Âm dương: </span>
                            {{$user['gender_text']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Bắt đầu tu luyện: </span>
                            {{ dateFormat($user['created_at'], 'd/m/Y') }}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">Vai trò:</span>
                            {{$user['group']['name']}}
                        </li>
                        <li class="mb-1">
                            <span class="font-bold">User ID:</span>
                            {{$user['id']}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
