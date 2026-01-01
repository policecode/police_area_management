<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['getProfile', 'getProfileComments']);
    }
    public function getProfile(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $dataView = array(
            'page_title' => 'Lai lịch đạo hữu ' . $user->name,
            'description' => 'Thông tin đạo hữu ' . $user->name,
            'user' => $user,
            'is_nav' => 1
        );
        return view('member_profile.profile', $dataView);
    }

        public function getProfileVotes(Request $request, $user_id)
    {
        return 'getProfileVotes';
        $queryDefault = array(
            'page' => 1,
            'per_page' => 16,
            'order_by' => 'id',
            'order_type' => 'DESC',
            'parent_id' => 0
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = Comment::JoinStory()->GetByUser($user_id);
        $count = $query->count();
        $CommentCollection = $query->filter($request)->get();
        // dd($CommentCollection->toArray());
        $user = User::find($user_id);
        $dataView = array(
            'page_title' => 'Bình luận của đạo hữu ' . $user->name,
            'description' => 'Bình luận của đạo hữu ' . $user->name,
            'user' => $user,
            'is_nav' => 2,
            'records' => $CommentCollection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
        );
        return view('member_profile.profile_comment', $dataView);
    }
    public function getProfileComments(Request $request, $user_id)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 16,
            'order_by' => 'id',
            'order_type' => 'DESC',
            'parent_id' => 0
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = Comment::JoinStory()->GetByUser($user_id);
        $count = $query->count();
        $CommentCollection = $query->filter($request)->get();
        // dd($CommentCollection->toArray());
        $user = User::find($user_id);
        $dataView = array(
            'page_title' => 'Bình luận của đạo hữu ' . $user->name,
            'description' => 'Bình luận của đạo hữu ' . $user->name,
            'user' => $user,
            'is_nav' => 3,
            'records' => $CommentCollection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
        );
        return view('member_profile.profile_comment', $dataView);
    }

    public function getProfileDetail(Request $request)
    {
        $dataView = array(
            'page_title' => 'Thông tin cá nhân',
            'description' => 'Cập nhật thông tin cá nhân',
        );
        return view('member_profile.profile_detail', $dataView);
    }

    public function payment(Request $request)
    {
        return 'payment';
    }

    public function alert(Request $request)
    {
        return 'alert';
    }

    public function mystory(Request $request)
    {
        return 'mystory';
    }

    public function gilfcode(Request $request)
    {
        return 'gilfcode';
    }
}
