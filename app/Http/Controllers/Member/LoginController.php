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
class LoginController extends Controller
{
    public function showFormLogin() {
        $dataView = array(
            'page_title' => 'Đăng nhập',
        );
        return view('member_auth.login', $dataView);
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
