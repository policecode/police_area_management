@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-item-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vui lòng kích hoạt tài khoản của bạn</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Một liên kết xác minh đã được gửi đến địa chỉ email của bạn
                        </div>
                    @endif

                    Trước khi tiếp tục, vui lòng kiểm tra email của bạn để liên kết xác minh tài khoản.
                    Nếu bạn chưa nhận được email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Gửi lại email</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
