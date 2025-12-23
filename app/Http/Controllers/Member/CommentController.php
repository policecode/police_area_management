<?php

namespace App\Http\Controllers\Member;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['getListComments']);
    }

    public function getListComments(Request $request) {
        try {
            $queryDefault = array(
                'parent_id_max' => 0,
                'is_views_not' => CommentStatus::SPAM['key']
            );
            $request->merge(array_merge($queryDefault, $request->query()));
            // DB::enableQueryLog();
            $query = Comment::joinUsers()->filter($request);
            // dd(DB::getQueryLog());
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
                $now = Carbon::now();
                $dataCollection = $query->get();
                $listId = $dataCollection->pluck('id')->toArray();
                $allCommentChild = Comment::GetCommentChild($listId);
                $res['data']  = $dataCollection->each(function ($item, $key) use($now, $allCommentChild){
                    $item->url_avatar = $item->avatar? asset($item->avatar):asset('assets/images/avatar_default.png');
                    $item->url_profile = route('member.profile', ['user_id' => $item->user_id]);
                    $item->after_minutes = $now->diffInMinutes(new Carbon($item->created_at));
                    $item->childs = empty($allCommentChild[$item->id])?[]:$allCommentChild[$item->id];
                });
            }
            return response()->json($res);
          } catch (\Throwable $e) {
            return response()->json([
                'result' => 0, 'data'=> [], 'message' => $e->getMessage()
            ], 400);
          }
    }

    public function postComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story_id' => 'required|numeric',
            'parent_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $checkId = Comment::find($value);
                if (!($checkId || $value == 0)) {
                    // Xảy ra lỗi
                    $fail(':attribute not valid');
                }
            }],
            'content' => 'required|min:3|max:1000',
            'ask_user_id' => ''
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        DB::beginTransaction();
        try {
            $data = $validator->validated();
            $user = Auth::user();
            $story = Story::find($data['story_id']);
            $collection = Comment::create([
                'user_id' => $user->id,
                'story_id' => $data['story_id'],
                'parent_id' => $data['parent_id'],
                'content' => $data['content'],
                'ask_user_id' => $data['ask_user_id'],
                'is_views' => CommentStatus::UNREAD['key']
            ]);
            $story->total_comment += 1;
            if ($collection->parent_id == 0) {
                $story->last_comment_id = $collection->id;
            }

            $story->update();
            $comment = Comment::JoinUsers()->find($collection->id);
            $comment->after_minutes = 0;
            $comment->url_avatar = $comment->avatar ? asset($comment->avatar) : asset('assets/images/avatar_default.png');

            if ($comment->parent_id == 0) {
                $comment->childs = [];
            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $comment,
                'message' => 'Post comment success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function likeComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_id' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        DB::beginTransaction();
        try {
            $data = $validator->validated();
            $user = Auth::user();
            $comment = Comment::find($data['comment_id']);
            $commentLike = LikeComment::GetByUser($user->id)->GetByComment($data['comment_id'])->first();
            if ($commentLike) {
                LikeComment::GetByUser($user->id)->GetByComment($data['comment_id'])->delete();
                $comment->like -= 1;
                $comment->update();
            } else {
                $collection = LikeComment::create([
                    'user_id' => $user->id,
                    'comment_id' => $data['comment_id']
                ]);
                $comment->like += 1;
                $comment->update();
            }
            $respone = Comment::joinUsers()->where('comments.id', '=', $data['comment_id'])->first();
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $respone,
                'message' => 'Like comment success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
