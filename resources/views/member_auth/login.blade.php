@extends('layouts.auth_member')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <section class="section-regis py-12 bg-[#f2f3f5] flex items-center ">
        <div class="container">
            <div class="module-content max-w-[450px] mx-auto  lg:p-7 p-4">
                <p class="title font-bold text-center xl:text-[1.875rem] text-[1.25rem] text-[#373941] mb-5">Đăng nhập</p>
                <form action="https://blhvip.vn/dang-nhap" method="POST" class="form formValidation" accept-charset="utf8"
                    absolute="" data-success="NOTIFICATION.toastrMessageRedirect">
                    <input type="hidden" name="_token" value="zitjzSoPuAJrAHFLZayRFsaIwnv7FEnqclVGS7qW"> <input
                        type="text" name="username" placeholder="Nhập email"
                        class="form-control rounded bg-white w-full border border-solid border-[#128c7e] text-[0.875rem] outline-none mb-4 p-4"
                        rules="required||email" m-required="Vui lòng Nhập email"
                        m-email="Vui lòng nhập email đúng định dạng">
                    <input type="password" name="password" placeholder="Nhập mật khẩu"
                        class="form-control rounded bg-white w-full border border-solid border-[#128c7e] text-[0.875rem] outline-none mb-4 p-4"
                        rules="required" m-required="Vui lòng nhập mật khẩu">
              
                    <button type="submit" class="btn btn-green w-full !rounded-md lg:text-[1.125rem] mb-4">Đăng
                        nhập</button>
                    <a href="javascript:void(0)" title="Quên mật khẩu" class="link text-[#222] block w-fit mx-auto mb-4"
                        modal-rs-target="foget_pass" style="cursor: pointer;">Quên mật khẩu</a>
                    <a href="https://blhvip.vn/dang-ky" title="Đăng ký"
                        class="btn btn-border-green !flex w-fit mx-auto !rounded-md min-w-[200px]">Đăng ký</a>
                </form>
                <p class="mt-5 text-center">Hoặc đăng nhập qua</p>
                <div class="text-center">
                    <a href="login-social/google" class="smooth icon-login-social google" title="Đăng nhập qua Google"><i
                            class="fa-brands fa-google"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
