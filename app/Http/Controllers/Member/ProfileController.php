<?php

namespace App\Http\Controllers\Member;

use App\Enums\FavoriteStatus;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\StarRating;
use App\Models\User;
use App\Models\UserReadStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        );
        return view('member_profile.profile', $dataView);
    }

    public function getProfileVotes(Request $request, $user_id)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
            'order_by' => 'id',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = StarRating::JoinStory()->GetByUser($user_id);
        $count = $query->count();
        $StarRatingsCollection = $query->filter($request)->get();
        // dd($StarRatingsCollection->toArray());
        $user = User::find($user_id);
        $dataView = array(
            'page_title' => 'Bình luận của đạo hữu ' . $user->name,
            'description' => 'Bình luận của đạo hữu ' . $user->name,
            'user' => $user,
            'records' => $StarRatingsCollection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
        );
        return view('member_profile.profile_votes', $dataView);
    }

    public function getProfileComments(Request $request, $user_id)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
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
            'records' => $CommentCollection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
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
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
            'order_by' => 'updated_at',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = UserReadStory::JoinStoryChapterAuthor()->GetByUser(Auth::id())->GetByLastChapter();
        $count = $query->count();
        $collection = $query->filter($request)->get()->each(function ($item, $key) {
            $isResult = strpos($item['story_title'], '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        });
        // dd($collection->toArray());
        $breadcrumb = [
            [
                "title" => "Trình quản trị",
                "url" => route('member.profile_detail', [])
            ],
            [
                "title" => 'Công pháp đã tu luyện',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Công pháp của ta',
            'description' => 'Thông tin các bộ công pháp ta đã tu luyện',
            'records' => $collection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('member_profile.profile_story_read', $dataView);
    }

    public function mystoryFavorite(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
            'order_by' => 'updated_at',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = UserReadStory::JoinStoryAuthor()->GetByUser(Auth::id())->GetByFavorite(FavoriteStatus::LIKE['id']);
        $count = $query->count();
        $collection = $query->filter($request)->get()->each(function ($item, $key) {
            $isResult = strpos($item['story_title'], '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        });
        // dd($collection->toArray());
        $breadcrumb = [
            [
                "title" => "Trình quản trị",
                "url" => route('member.profile_detail', [])
            ],
            [
                "title" => 'Tàng Kinh Các',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Tàng Kinh Các',
            'description' => 'Thông tin các bộ công pháp ta đã lưu lại',
            'records' => $collection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('member_profile.profile_story_favorites', $dataView);
    }

    public function callApiMyStory(Request $request)
    {
        try {
            if ($request->status == 'read') {
                $query = UserReadStory::filter($request)->JoinStoryChapterAuthor()->GetByUser(Auth::id())->GetByLastChapter();
            } else if ($request->status == 'favorite') {
                $query = UserReadStory::filter($request)->JoinStoryAuthor()->GetByUser(Auth::id())->GetByFavorite(FavoriteStatus::LIKE['id']);
            }
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $request->page,
                'per_page' => $request->per_page,
                'total' => 0
            ];
            if ($request->is_paginate) {
                $res['total'] = $query->count();
            } else {
                $collection = $query->get();
               $status = $request->status;
                $res['data'] = $collection->each(function ($item, $key) use ($status) {
                    $item->story_url =  route('client.story', ['story_slug' => $item->story_slug]);
                    $item->author_url =  route('client.author', ['author_slug' => $item->author_slug]);
                    if ($status == 'read') {
                        if ($item->chapter_position) {
                            $item->chapter_url =  route('client.chaper', ['story_slug' => $item->story_slug, 'chaper_position' => $item->chapter_position]);
                        } else {
                            $item->chapter_url =  '#';
                        }
                    }
             
                    $isResult = strpos($item->title, '(c)');
                    if ($isResult) {
                        $item->is_convert = true;
                    } else {
                        $item->is_convert = false;
                    }
                })->toArray();
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function gilfcode(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trình quản trị",
                "url" => route('member.profile_detail', [])
            ],
            [
                "title" => 'Nhập Giftcode',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Nhập Giftcode',
            'description' => 'Nhập mã để lấy hầu bao',
            'breadcrumb' => $breadcrumb
        );
        return view('member_profile.profile_gilfcode', $dataView);
    }
}
