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
                        src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}" style="max-height: 150px;"
                        alt="Hắc Hoàng Đại Đế" class="img-fluid" />
                </picture>
                <div class="text-center">
                    <p class="title font-bold text-center xl:text-[1.875rem] text-[1.25rem] text-[#373941] mb-5">{{ $page_title }}</p>
                    @if (session('msg'))
                        <div class="flex items-center justify-between mb-2 head-all text-white p-4" style="background-color: #128c7e">{{session('msg')}}</div>
                    @endif
                    @if (session('msgError'))
                        <div class="flex items-center justify-between mb-2 head-all text-white p-4" style="background-color: #d25959">{{session('msgError')}}</div>
                    @endif
                </div>
                <form action="{{ route('member.login') }}" method="POST" class="form formValidation" accept-charset="utf8">
                    @csrf
                    @method('POST')
                    <input type="text" value="{{old('email')}}" name="email" placeholder="Nhập email"
                        class="form-control w-full bg-none border-b-[1px] border-solid border-[#e5e9ea] text-[0.875rem] outline-none mb-2"
                        @error('email') style="border: 1px solid rgb(255, 110, 124);" @enderror>
                    @error('email')
                        <p class="ml-2 mb-4" style="color: rgb(255, 110, 124);"><strong>{{ $message }}</strong></p>
                    @enderror

                    <input type="password"  value="{{old('password')}}" name="password" placeholder="Nhập mật khẩu"
                        class="form-control w-full bg-none border-b-[1px] border-solid border-[#e5e9ea] text-[0.875rem] outline-none mb-2"
                        @error('password') style="border: 1px solid rgb(255, 110, 124);" @enderror>
                    @error('password')
                        <p class="ml-2 mb-4" style="color: rgb(255, 110, 124);"><strong>{{ $message }}</strong></p>
                    @enderror
              
                    <button type="submit" class="btn btn-green w-full !rounded-md lg:text-[1.125rem] mb-4">Đăng nhập</button>
                    <a href="javascript:void(0)" title="Quên mật khẩu" class="link text-[#222] block w-fit mx-auto mb-4"
                        modal-rs-target="foget_pass" style="cursor: pointer;">Quên mật khẩu</a>
                    <a href="{{ route('member.form_register') }}" title="Đăng ký"
                        class="btn btn-border-green !flex w-fit mx-auto !rounded-md min-w-[200px]">Đăng ký</a>
                </form>
                <p class="mt-5 text-center">Hoặc đăng nhập qua</p>
                <div class="text-center">
                   <a href="{{ route('auth.socialite.google') }}" class="smooth icon-login-social google" title="Đăng nhập qua Google"><i class="fa-brands fa-google"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
