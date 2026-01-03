<?php

namespace App\Http\Controllers\Member;

use App\Enums\FavoriteStatus;
use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\TopMemberDay;
use App\Models\User;
use App\Models\UserReadStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberActionController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['getTopMember']);
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

    public function saveFavoriteStory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'story_id' => 'required|exists:stories,id'
        ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
        
            $story = Story::find($data['story_id']);
            $user = User::find(Auth::id());
            $userReadStory = UserReadStory::GetByUser($user->id)->GetByStory($story->id)->first();
            $message = '';
            $is_favorite = false;
            if ($userReadStory) {
                if ($userReadStory->favorite == FavoriteStatus::LIKE['id']) {
                    $userReadStory->favorite = FavoriteStatus::NOTINTERESTED['id'];
                    $userReadStory->update();
                    $story->total_favorite -= 1;
                    $story->update();
                    $message = 'Bỏ công pháp khỏi Tàng Kinh Các';
                } else {
                    $userReadStory->favorite = FavoriteStatus::LIKE['id'];
                    $userReadStory->update();
                    $story->total_favorite += 1;
                    $story->update();
                    $message = 'Thêm công pháp vào Tàng Kinh Các';
                    $is_favorite = true;
                }
            } else {
                $userReadStory = UserReadStory::create([
                    'user_id' => $user->id,
                    'story_id' => $story->id,
                    'last_chapter_id' => null,
                    'story_count' => 0,
                    'favorite' => FavoriteStatus::LIKE['id']
                ]);
                $story->total_favorite += 1;
                $story->update();
                $message = 'Thêm công pháp vào Tàng Kinh Các';
                $is_favorite = true;
            }
            // $story->update();
        
            // Xử lý khi đã đăng nhập
         
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => [],
                'is_favorite' => $is_favorite,
                'message' => $message
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
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
            if (!empty($data['password'])) {
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
                'message' => 'Cập nhật thông tin cá nhân thất bại.',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function getTopMember(Request $request) {
          try {
            if ($request->view == 'day') {
                $query = TopMemberDay::filter($request)->getByKey(get_key_by_day());
            } elseif ($request->view == 'all') {
                $query = User::filter($request);
            }

            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
                'total' => 0
            ];
            if($request->is_paginate){
                $res['total'] = $query->getTotal();
            }else{
                if ($request->view == 'all') {
                    $colection = $query->get();
                    $res['data']  = $colection->each(function ($item, $key) {
                        $item->profile_url = route('member.profile', ['user_id' => $item['id']]);
                    });
                } else {
                    $colection = $query->joinUser()->get();
                    $res['data']  = $colection->each(function ($item, $key) {
                        $item->profile_url = route('member.profile', ['user_id' => $item['user_id']]);
                        $item->avatar_url = $item->avatar ? asset($item->avatar) : asset('assets/images/avatar_default.png');
                    });
                }
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0, 'data'=> [], 'message' => $e->getMessage()
            ], 400);
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
