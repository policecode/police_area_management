<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\GroupRole;
use App\Mail\ActivationMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::MEMBERREGISTER;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function testmail()
    {
        return view('mails.activation');
    }

    public function showFormRegister()
    {
        $dataView = array(
            'page_title' => 'Đăng ký',
        );
        return view('member_auth.register', $dataView);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $token = Str::random(64);
        $user = $this->create($request->all(), $token);
        // event(new Registered($user));
        Mail::to($user->email)
            // ->cc('fvnnguyenbinhminh1988@gmail.com')
            ->send(new ActivationMail($user, $token)); //php artisan make:mail ActivationMai

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->intended(RouteServiceProvider::MEMBERLOGIN)->with('msg', 'Đăng ký tài khoản thành công, mời bạn  đăng nhập vào email ' . $request->email . ' để kích hoạt tài khoản');
    }

    public function emailVerify(Request $request, $remember_token)
    {
        $user = User::GetByRememberToken($remember_token)->first();
        if ($user) {
            $user->remember_token = '';
            $user->email_verified_at = Carbon::now();
            $user->update();
            $msg =  'Kích hoạt tài khoản ' . $user->email . ' thành công';
        } else {
            $msg = 'Đường link đã hết hạn';
        }
        return redirect('/member/login')->with('msg', $msg);
    }

    public function repeatVetifyForm(Request $request, $email)
    {
        $user = User::getByEmail($email)->first();
        if ($user && $user->email_verified_at) {
            return redirect(RouteServiceProvider::MEMBERLOGIN)->with(['msg' => 'Tài khoản: '.$user->email.' đã được kích hoạt']);
        }

        $dataView = array(
            'page_title' => 'Vertify Email',
            'email' => $email
        );
        return view('member_auth.verify', $dataView);
    }

    public function repeatVetify(Request $request, $email)
    {
        $user = User::getByEmail($email)->first();
        $token = Str::random(64);
        $user->remember_token = $token;
        $user->update();
        Mail::to($user->email)->send(new ActivationMail($user, $token));
        return back()->with(['resent' => 'Một liên kết xác minh đã được gửi đến địa chỉ email: '.$user->email.' của bạn']);
    }
    // public function testmail() {
    //     $data = [
    //         'name' => 'test name for email'
    //     ];
    //     Mail::send('emails.test',$data, function($email) {
    //         $email->to('fvnnguyendinhnam1998@gmail.com', 'Đồ Đồng Nát');
    //     });
    //     return 'test mail';
    // }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
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
            ]
        );
    }

    protected function create(array $data, $token)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'group_id' => GroupRole::READER['id'],
            'remember_token' => $token
        ]);
    }
}
