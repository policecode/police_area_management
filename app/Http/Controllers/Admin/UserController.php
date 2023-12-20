<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
        
    }
    public function index (Request $request) {
        // echo $request->route()->getName();
        // return response()->json(User::paginate(10));
        $queryDefault = array(
            'per_page' => 10
        );
        // Thêm dữ liệu vào trong query
        $request->merge(array_merge($queryDefault, $request->query()));
        // dd($request->all());
        $query = User::filter($request);
        $dataView = array(
            'page_title' => 'Quản lý người dùng',
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        );
        return view('admin_page.users.lists', $dataView);
    }

    public function data(Request $request) {
        $query = User::filter($request);
        $res = [
            'records' => $query->get(),
            'page' => $query->getPageNumber(),
            'per_page' => $query->getPerPage(),
            'total_records' => $query->getTotal()
        ];
        return response()->json($res);
    }

    public function create(Request $request) {
        $dataView = array(
            'page_title' => 'Thêm người dùng mới'   
        );
        return view('admin_page.users.create', $dataView);
    }

    public function store(UserRequest $request) {
        $data = $request->validated();
     
        User::create(array_merge($data, array(
            'password' => bcrypt($request->password),
            'group_id' => (int) $request->group_id
        )));
        return redirect()->route('admin.users.index')->with('msg', __('messages.success_user'));
    }

    public function edit(Request $request, User $user) {
        $dataView = array(
            'page_title' => 'Chỉnh sửa thông tin người dùng',
            'item' => $user
        );
        return view('admin_page.users.edit', $dataView);

    }

    public function update(UserRequest $request, User $user) {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return back()->with('msg', __('messages.success_update_user'));
    }

    public function delete(Request $request, User $user) {
        $user->delete();
        return back()->with('msg', __('messages.success_delete_user'));
    }
}
