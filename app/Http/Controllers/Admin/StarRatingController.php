<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StarRating;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StarRatingController extends Controller
{
     public function index(Request $request)
    {
        $dataView = array(
            'page_title' => 'Quản lý đánh giá sao',
        );
       
        return view('admin_page.star_ratings.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));
    
      try {
        //code...
        $query = StarRating::JoinStoryAndUser()->filter($request);
        if (isset($request->story) && ((int)$request->story > 0)) {
            $query->where('star_ratings.story_id', $request->story);
        }
        if( isset($request->user) && ((int)$request->user > 0)) {
            $query->where('star_ratings.user_id', $request->user);
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

            $res['data']  = $dataCollection->each(function ($item, $key) use($now){
                $item->url_avatar = $item->avatar? asset($item->avatar):asset('assets/images/avatar_default.png');
                if ($item->user_id) {
                    $item->url_profile = route('member.profile', ['user_id' => $item->user_id]);
                } else {
                    $item->url_profile = 'javascript:void(0)';
                }
                $item->url_story = route('client.story', ['story_slug' => $item->slug]);
                $item->after_minutes = $now->diffInMinutes(new Carbon($item->created_at));
            });
        }
        return response()->json($res);
      } catch (\Throwable $e) {
        return response()->json([
            'result' => 0, 'data'=> [], 'message' => $e->getMessage()
        ], 400);
      }
  }

   public function destroy($starRating)
    {
        DB::beginTransaction();
        try {
            $starRating = StarRating::where('id', $starRating)->first();
            $story = Story::find($starRating->story_id);
            $count = StarRating::where('id', $starRating->id)->delete();
            $starAvg = StarRating::getByStory($starRating->story_id)->get()->avg('point_star');
   
            $story->star_count = $story->star_count - 1;
            if ($story->star_count < 0) {
                $story->star_count = 0;
            }
            $story->star_average = number_format($starAvg, 1);
        
            $story->save();
            DB::commit();
            return response()->json([
                'status' => $count, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }
}
