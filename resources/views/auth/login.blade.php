@extends('layouts.auth')
@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{$title}}</h1>
                                </div>
                                <form class="user" action="{{route('auth.login')}}" method="POST">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                            aria-describedby="emailHelp" placeholder="Email hoặc Tài khoản đăng nhập..." value="{{old('email')}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control form-control-user  @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Mật khẩu">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert" style="padding: 0 5%;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Đăng nhập
                                    </button>
                                    @csrf
                                    @method('POST')
                                    {{-- <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a> --}}
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{route('auth.register_form')}}">Tạo tài khoản mới!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('scripts')
<script>

</script>
@endsection