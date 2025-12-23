<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $request, $user_id) {
        return 'profile '.$user_id;
    }

    public function getProfileDetail(Request $request) {
        return 'getProfileDetail';
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
