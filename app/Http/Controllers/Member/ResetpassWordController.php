<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Mail\ResetpasswordMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ResetpassWordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showFormForgotPassword()
    {
        $dataView = array(
            'page_title' => 'Lấy lại mật khẩu',
        );
        return view('member_auth.get_link_resetpassword', $dataView);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::getByEmail($request->email)->first();
        if ($user) {
            if ($user->email_verified_at) {
                $token = Str::random(64);
                $user->remember_token = $token;
                $user->update();
                Mail::to($user->email)->send(new ResetpasswordMail($user, $token));
                return back()->with(['msg' => 'Một liên kết xác minh đã được gửi đến địa chỉ email: ' . $user->email . ' của bạn']);
            } else {
                return redirect(route('verification.notice', ['email' => $user->email]))->with(['msgError' => 'Tài khoản ' . $user->email . ' chưa được xác thực, vui lòng kiểm tra email để xác thực tài khoản']);
            }
        } else {
            return back()->with(['msgError' => 'Tài khoản: ' . $request->email . ' chưa được đăng ký']);
        }
    }

    public function showFormResetPassword(Request $request, $token) {
        $user = User::GetByRememberToken($token)->first();
        if ($user) {
            $dataView = array(
                'page_title' => 'Đặt lại mật khẩu',
                'user' => $user
            );
            return view('member_auth.resetpassword', $dataView);
        } else {
            return redirect(RouteServiceProvider::MEMBERLOGIN)->with(['msg' => 'Đường link đã hết hạn']);
        }
    }

    public function resetPassword(Request $request) {
        $this->validator($request->all())->validate();
        $user = User::getByEmail($request->email)->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = '';
        $user->update();
        return redirect(RouteServiceProvider::MEMBERLOGIN)->with(['msg' => 'Đặt lại mật khẩu cho tài khoản '.$user->email.' thành công']);
    }

    private function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
            ],
            [
                'required' => ':attribute bắt buộc phải nhập',
                'string' => ':attribute là chuỗi ký tự',
                'max' => ':attribute không được nhiều hơn :max ký tự',
                'email' => ':attribute không đúng định dạng email',
                'unique' => ':attribute đã tồn tại',
                'min' => ':attribute không được ít hơn :min ký tự',
                'same' => ':attribute không trùng khớp'
            ],
            [
                'email' => 'Tài khoản',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Mật khẩu nhập lại'
            ]
        );
    }
}
