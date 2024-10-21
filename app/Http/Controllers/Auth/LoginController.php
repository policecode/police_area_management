<?php

namespace App\Http\Controllers\Auth;

use App\Enums\GroupRole;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showFormLogin() {
        $dataView = array(
            'title' => 'Đăng nhập hệ thông'
        );
        return view('auth.login', $dataView);
    }

    protected function authenticated(Request $request, $user)
    {
        // Xử lý sau khi login
        return redirect(RouteServiceProvider::ADMIN);
    }
    protected function loggedOut(Request $request)
    {
        // Xử lý sau khi logout
        return redirect(RouteServiceProvider::HOME);

    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
            $this->username() => 'required|string',
            'password' => 'required|string',
            ],
            [
                'required' => ':attribute bắt buộc phải nhập',
                'string' => ':attribute là chuỗi ký tự',
            ],
            [
                'email' => 'Tài khoản',
                'password' => 'Mật khẩu',
            ]
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không chính xác'],
        ]);
    }
}
