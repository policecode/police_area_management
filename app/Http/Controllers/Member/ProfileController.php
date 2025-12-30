<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function getProfile(Request $request, $user_id) {
        return 'profile '.$user_id;
    }

    public function getProfileDetail(Request $request) {
          $dataView = array(
            'page_title' => 'Thông tin cá nhân',
            'description' => 'Cập nhật thông tin cá nhân',
        );
        return view('member_profile.profile_detail', $dataView);
    }

    public function payment(Request $request) {
        return 'payment';
    }

     public function alert(Request $request) {
        return 'alert';
    }

    public function mystory(Request $request) {
        return 'mystory';
    }

    public function gilfcode(Request $request) {
        return 'gilfcode';
    }
}
