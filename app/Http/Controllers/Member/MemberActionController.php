<?php

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberActionController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function uploadAction(Request $request, $action) {
        // action: avatar, banner
        if (!in_array($action, ['avatar', 'banner'])) {
            return response()->json([
                'status' => 0,
                'message' => 'Hành động không hợp lệ.'
            ]);
        }
        try {
            $user = User::find(Auth::id());
            if ($request->hasFile('avatar') && $action == 'avatar') {
                Storage::delete($user->avatar);
                $image = $request->file('avatar')->store('member/avatar');
                $user->avatar = $image;
                $user->save();
            }
            if ($request->hasFile('banner') && $action == 'banner') {
                Storage::delete($user->banner);
                $image = $request->file('banner')->store('member/banner');
                $user->banner = $image;
                $user->save();
            }
            return response()->json([
                'status' => 1,
                'message' => 'Tải ảnh lên thành công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Tải lên thất bại.'
            ]);
        }

    }

    public function updateProfile(Request $request) {
        
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        $data = $validator->validated();
        try {
            $user = User::find(Auth::id());
            $user->name = $data['name'];
            $user->gender = $data['gender'];
            $user->date_of_birth = $data['date_of_birth'];
            if ($data['password']) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => 'Cập nhật thông tin cá nhân thành công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Cập nhật thông tin cá nhân thất bại.'
            ]);
        }
    }

    private function rules($request)
    {
        $rules = [
            'name' => ['required', 'max:255', 'unique:stories,title'],
            'gender' => '',
            'date_of_birth' => '',

        ];
        if ($request->password || $request->password_confirmation) {
            $rules += [
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
            ];
        }
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải từ :min ký tự',
            'integer' => ':attribute phải là số',
            'same' => ':attribute không trùng khớp',
            'string' => ':attribute phải là chuỗi ký tự',
            'max' => ':attribute không được nhiều hơn :max ký tự',
        ];
    }

    private function attributes()
    {
        return [
            'name' => 'Danh tính',
            'gender' => 'Âm Dương',
            'date_of_birth' => 'Sinh thần',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Mật khẩu nhập lại'
        ];
    }
}
