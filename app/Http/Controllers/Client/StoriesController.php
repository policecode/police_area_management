<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chaper;
use App\Models\StarRating;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $story_slug)
    {
        $story = Story::with('categories')->joinAuthor()->getBySlug($story_slug)->first();
        $story->thumbnail = route('index') . '/' . $story->thumbnail;
        $story = $story->toArray();
        // dd($story);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => $story['title'],
                "url" => ''
            ]
        ];

        $dataView = array(
            'page_title' => ucwords($story['title']),
            'story' => $story,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.stories', $dataView);

    }

    public function getListChapers(Request $request) {
        try {
            //code...
            $query = Chaper::joinStory()->filter($request);
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
                $res['data']  = $query->get()->each(function ($item, $key) use($now){
                    $item->url = route('client.chaper', [
                        'story_slug' => $item->story_slug,
                        'chaper_slug' => $item->slug,
                    ]);
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

    public function ratingStar(Request $request) {
        try {
            $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0, 
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
            $user = Auth::user();
            $flag = false;
            if ($user) {
                $flag = StarRating::getByUser($user->id)->getByStory($data['story_id'])->getByKeydate(get_key_by_day())->first();
            } else {
                $flag = StarRating::getByIpAdress($request->ip())->getByStory($data['story_id'])->getByKeydate(get_key_by_day())->first();
            }
            if ($flag) {
                return response()->json([
                    'status' => 0, 
                    'message' => 'Bạn đã bình chọn cho bộ tuyện này trong ngày hôm nay, ngày mai bạn hãy quay lại đây',
                ]);
            }

            $dataStar = array(
                'story_id' => $data['story_id'],
                'point_star' => $data['point_star'],
                'ip_address' => $request->ip(),
                'key_date' => get_key_by_day()
            );
            if ($user) {
                $dataStar['user_id'] = $user->id;
            }
            $voteStar = StarRating::create($dataStar);
            $starAvg = StarRating::getByStory($voteStar->story_id)->get()->avg('point_star');
    
            $story = Story::find($voteStar->story_id);
            $story->star_count = $story->star_count + 1;
            $story->star_average = number_format($starAvg, 1);
            $story->update();
           
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $starAvg,
                'message' => 'Cảm ơn bạn đã bình chọn cho bộ truyện'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'story_id' => 'required|exists:stories,id',
            'point_star' => 'integer|min:1|max:10',
        ];
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute thấp nhất :min điểm',
            'max' => ':attribute cao nhất :max điểm',
            'integer' => ':attribute phải là số',
            'exists' => ':attribute không tồn tại'
        ];
    }

    private function attributes()
    {
        return [
            'story_id' => 'Tên truyện',
            'point_star' => 'Điểm bình chọn',
        ];
    }
}
