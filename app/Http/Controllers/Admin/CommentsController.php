<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommentsController extends Controller
{
     public function index(Request $request)
    {
        $dataView = array(
            'page_title' => 'Quản lý bình luận',
        );
       
        return view('admin_page.comments.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));

      try {
        //code...
        $query = Comment::JoinUsersAndStory()->filter($request);
        if (isset($request->story) && ((int)$request->story > 0)) {
            $query->where('comments.story_id', $request->story);
        }
        if( isset($request->user) && ((int)$request->user > 0)) {
            $query->where('comments.user_id', $request->user);
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
            $now = Carbon::now();
            $dataCollection = $query->get();
            $listId = $dataCollection->pluck('id')->toArray();
            $allCommentChild = Comment::GetCommentChild($listId);
            $res['data']  = $dataCollection->each(function ($item, $key) use($now, $allCommentChild){
                $item->url_avatar = $item->avatar? asset($item->avatar):asset('assets/images/avatar_default.png');
                $item->url_profile = route('member.profile', ['user_id' => $item->user_id]);
                $item->url_story = route('client.story', ['story_slug' => $item->slug]);
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

   public function destroy($comment)
    {
        try {
            $count = Comment::where('id', $comment)->orWhere('parent_id', $comment)->delete();
    
            return response()->json([
                'status' => $count, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }
}
