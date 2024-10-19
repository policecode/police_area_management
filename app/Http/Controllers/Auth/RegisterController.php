<?php

namespace App\Http\Controllers\Auth;

use App\Enums\GroupRole;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::REGISTER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $dataView = array(
            'title' => 'Tạo tài khoản mới'
        );
        return view('auth.register', $dataView);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath())->with('msg', 'Đăng ký tài khoản thành công, mời bạn  đăng nhập vào email '.$request->email.' để kích hoạt tài khoản');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
            'name' => 'Họ và tên',
            'email' => 'Tài khoản',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu nhập lại'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'group_id' => GroupRole::READER['id']
        ]);
    }
}
