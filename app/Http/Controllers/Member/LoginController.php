<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Enums\GroupRole;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        // Xử lý sau khi login
        return redirect(RouteServiceProvider::HOME);
    }
    protected function loggedOut(Request $request)
    {
        // Xử lý sau khi logout
        return redirect(RouteServiceProvider::HOME);
    }
    public function showFormLogin()
    {
        $dataView = array(
            'page_title' => 'Đăng nhập',
        );
        return view('member_auth.login', $dataView);
    }

public function login(Request $request)
    {
        $this->validateLogin($request);
        $dataLogin = $request->only('email', 'password');
        $checkLogin = Auth::attempt($dataLogin, true);
        if ($checkLogin) {
            $user = Auth::user();
            if (!$user->email_verified_at) {
                Auth::guard('web')->logout();
                return redirect(route('verification.notice', ['email' => $user->email]))->with(['msgError' => 'Tài khoản '.$user->email.' chưa được xác thực, vui lòng kiểm tra email để xác thực tài khoản']);
            }
            return redirect()->intended(RouteServiceProvider::MEMBERPROFILE);
        }
        return back()->withInput()->withErrors(['password' => 'Mật khẩu không chính xác']);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
            $this->username() => 'required|string|email|exists:users,email',
            'password' => 'required|string',
            ],
            [
                'required' => ':attribute bắt buộc phải nhập',
                'string' => ':attribute là chuỗi ký tự',
                'email' => ':attribute phải là định dạng email',
                'exists' => ':attribute chưa được đăng ký',
            ],
            [
                'email' => 'Tài khoản',
                'password' => 'Mật khẩu',
            ]
        );
    }


    public function redirectSocialiteGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginSocialiteGoogle()
    {
        $user = Socialite::driver('google')->user();
        $isUser = User::getByEmail($user['email'])->first();
        if ($isUser > 0) {
            Auth::login($isUser, true);
        } else {
            // Chưa có tài khoản, tiến hành tạo mới và đăng nhập
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make(Str::random(12)), // Mật khẩu ngẫu nhiên
                'email_verified_at' => Carbon::now(),
                'avatar' => $user->avatar,
                'socialite' => 'google',
                'socialite_id' => $user['id'],
                'group_id' => GroupRole::READER['id'],
            ]);
            Auth::login($newUser, true);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
