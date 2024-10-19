@extends('layouts.auth')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                            @if (session('msg'))
                                <div class="alert alert-success">{{session('msg')}}</div>
                            @endif
                        </div>
                        <form class="user" action="{{ route('auth.store') }}" method="POST">
                            <div class="form-group">
                                <input name="name" type="text" value="{{old('name')}}"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    placeholder="Full Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input name="email" type="text" value="{{old('email')}}"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" value="{{old('password')}}"
                                    class="form-control form-control-user  @error('password') is-invalid @enderror"
                                    placeholder="Mật khẩu">
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input name="password_confirmation" type="password"
                                    class="form-control form-control-user  @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Nhập lại mật khẩu">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Tạo tài khoản
                            </button>
                            @csrf
                            @method('POST')
                            {{-- <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Register with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                        </a> --}}
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('auth.form_login') }}">Bạn đã có tài khoản? Đăng nhập!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
