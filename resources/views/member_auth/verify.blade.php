<?php
use App\Http\Helpers\SettingHelpers;

$option = SettingHelpers::getInstance();
?>
@extends('layouts.auth_member')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <section class="section-regis py-12 bg-[#f2f3f5] flex items-center ">
        <div class="container">
            <div class="module-content max-w-[450px] mx-auto  lg:p-7 p-4">
                <picture class="flex justify-center">
                    <img loading="auto"
                        src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        style="max-height: 150px;" alt="Hắc Hoàng Đại Đế" class="img-fluid" />
                </picture>
                <div class="text-center">
                    <p class="title text-center xl:text-[1.875rem] text-[1.25rem] text-[#373941] mb-5">Vui lòng kích hoạt
                        tài khoản <b>{{ $email }}</b> của bạn</p>
                    @if (session('resent'))
                        <div class="flex items-center justify-between mb-2 head-all text-white p-4"
                            style="background-color: #128c7e">{{session('resent')}}
                        </div>
                    @endif
                </div>
                <p class="title text-center mb-5">Trước khi tiếp tục, vui lòng kiểm tra email của bạn để liên kết xác minh
                    tài khoản. Nếu bạn chưa nhận được email,</p>
                <form action="{{ route('verification.repeat', ['email' => $email]) }}" method="POST" class="form formValidation" accept-charset="utf8">
                    @csrf
                    @method('POST')

                    <button type="submit" class="btn btn-green w-full !rounded-md lg:text-[1.125rem] mb-4">Gửi lại
                        email</button>
                    <a href="{{ route('member.form_login') }}" title="Đăng ký"
                        class="btn btn-border-green !flex w-fit mx-auto !rounded-md min-w-[200px]">Quay lại trang đăng nhập</a>
                </form>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
