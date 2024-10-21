<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GroupRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct() {
        
    }
    private function rules($request)
    {
        $rules = [
            'name' => 'required|max:255',
            'password' => 'required|min:6',
            'group_id' => ['required', 'integer', function($attr, $value, $fail) {
                                                        if ($value === 0) {
                                                            $fail('Vui lòng chọn nhóm');
                                                        }                                        
                                                    }]
        ];
        if ($request->id) {
            if ($request->password) {
                $rules['password'] = 'min:6';
            } else {
                unset($rules['password']);
            }
        } else {
            $rules['email'] = 'required|email|unique:users,email';
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
            'integer' => ':attribute phải là số'
        ];
    }

    private function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khâu',
            'group_id' => 'Nhóm'
        ];
    }
    public function index (Request $request) {
        $groups = Group::where('slug', '!=', GroupRole::ADMIN['slug'])->get()->toArray();
        $dataView = array(
            'page_title' => 'Quản lý người dùng',
            'groups' => $groups
        );
        // dd(Gate::allows('admin.users.index'));
        return view('admin_page.users.lists', $dataView);
    }

    public function getItems(Request $request) {
          // Thêm dữ liệu vào trong query
        // $request->merge(array_merge($queryDefault, $request->query()));
        $query = User::filter($request);
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
            $res['data'] = $query->get();
        }
        return response()->json($res);
    }

    public function create(Request $request) {
        $dataView = array(
            'page_title' => 'Thêm người dùng mới'   
        );
        return view('admin_page.users.create', $dataView);
    }

    public function store(Request $request) {
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
            $result = User::create(array_merge($data, array(
                'password' => bcrypt($request->password),
                'group_id' => (int) $request->group_id,
                'email_verified_at' => Carbon::now()
            )));
            return response()->json([
                'status' => 1, 
                'data' => $result,
                'message' => 'Create success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    public function edit(Request $request, User $user) {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin người dùng',
            'item' => $user
        );
        return view('admin_page.users.edit', $dataView);

    }

    public function update(Request $request, User $user) {
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
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
            return response()->json([
                'status' => 1, 
                'data' => $user,
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete(Request $request, User $user) {
        try {
            $status = $user->delete();
            return response()->json([
                'status' => $status, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }
}
