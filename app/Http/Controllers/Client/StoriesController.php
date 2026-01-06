<?php

namespace App\Http\Controllers\Client;

use App\Enums\LockStories;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Chaper;
use App\Models\CoppyrightStory;
use App\Models\StarRating;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\ViewDay;
use App\Models\ViewMonth;
use App\Models\ViewWeek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StoriesController extends Controller
{

    private function isCoppyrightStory($story) {
        if ($story['is_lock'] != LockStories::LOCK['key']) {
            $user = Auth::user();
            if ($user) {
                $isCoppyright =CoppyrightStory::GetByUser($user->id)->GetByStory($story['id'])->first();
                if (!$isCoppyright) {
                    return true;
                    return view('client_page.coppyright', $dataView);
                }
            } else {
                return true;
                return view('client_page.coppyright', $dataView);
            }
        }
        return false;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $story_slug)
    {
        // $option = SettingHelpers::getInstance();
        $story = Story::with('categories')->joinAuthor()->getBySlug($story_slug)->first();
        
        $story->thumbnail = asset($story->thumbnail);
 
        $story = $story->toArray();
        // dd($story);
        $now = Carbon::now();
        $chapters = Chaper::joinStory()->getByStory($story['id'])->orderBy('position', 'DESC')->skip(0)->take(6)->get()->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $dt = new Carbon($item->created_at); //Tạo 1 datetime
            $item->after_minutes = $now->diffInMinutes($dt);
        })->toArray();
        $first_chapter = Chaper::joinStory()->getByStory($story['id'])->orderBy('position', 'ASC')->first();
        $first_chapter = $first_chapter?$first_chapter->toArray():NULL;
        $storyByAuthor = Story::joinAuthor()->getByAuthor($story['author_id'])->noById($story['id'])->get()->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item['title'], '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        $relatedStories = StoryCategory::joinStory()->getByCategoryId($story['categories'][0]['id'])->inRandomOrder()->take(10)->get()->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item['title'], '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();

        $starRatings = StarRating::JoinUser()->where('story_id', $story['id'])->orderBy('created_at', 'DESC')->skip(0)->take(6)->get()->toArray();
        // dd($starRatings->toArray());
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => $story['title'],
                "url" => route('client.story', [
                    'story_slug' => $story['slug']
                ])
            ]
        ];
     

        // Title Header
        $page_title = ucwords($story['title']).' | '.ucwords($story['author_name']);
        // Desccription Header
        $description = str_replace('<br />',' ', $story['description']);
        $arrDesc = explode(' ', $description, 50);
        unset($arrDesc[49]);
        $newArrDesc = array_filter($arrDesc, function($value) {
            return $value;
        });
        $description = implode(' ', $newArrDesc);

        $dataView = array(
            'page_title' => $page_title,
            'story' => $story,
            'breadcrumb' => $breadcrumb,
            'description' => $description,
            'chapters' => $chapters,
            'story_by_author' => $storyByAuthor,
            'related_stories' => $relatedStories,
            'first_chapter' => $first_chapter,
            'star_ratings' => $starRatings
        );
        $isCoppyright = $this->isCoppyrightStory($story);
        if ($isCoppyright) {
            return view('client_page.coppyright', $dataView);
        }
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
                        'chaper_position' => $item->position,
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
            $flag = StarRating::getByUser($user->id)->getByStory($data['story_id'])->first();
         
            if ($flag) {
                return response()->json([
                    'status' => 0, 
                    'message' => 'Bạn đã đánh giá bộ công pháp này, bạn có thể tìm hiểu những bộ công pháp',
                ]);
            }
  
            $voteStar = StarRating::create([
                'user_id' => $user->id,
                'story_id' => $data['story_id'],
                'point_star' => $data['point_star'],
                'ip_address' => $request->ip(),
                'content' => $data['content']
            ]);
            $starAvg = StarRating::getByStory($voteStar->story_id)->get()->avg('point_star');
    
            $story = Story::find($voteStar->story_id);
            $story->star_count = $story->star_count + 1;
            $story->star_average = number_format($starAvg, 1);
            $story->update();
           
            DB::commit();
            return response()->json([
                'status' => 1, 
                'data' => $starAvg,
                'message' => 'Cảm ơn bạn đã đưa ra đánh giá cho bộ công pháp này'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getTopViewStories(Request $request) {
        try {
            if ($request->view == 'day') {
                $query = ViewDay::filter($request)->getByKey(get_key_by_day('date'));
            } elseif ($request->view == 'week') {
                $query = ViewWeek::filter($request)->getByKey(get_key_by_day('week'));
            } elseif ($request->view == 'month') {
                $query = ViewMonth::filter($request)->getByKey(get_key_by_day('month'));
            } elseif ($request->view == 'all') {
                # code...
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
                $colection = $query->joinStory()->get();
                // $story_arr= $colection->pluck('id');
                // $listStoryCat = StoryCategory::getListCategoryByStory( $story_arr);
                $res['data']  = $colection->each(function ($item, $key) {
                    $item->thumbnail = route('index') . '/' . $item->thumbnail;
                    $item->url = route('client.story', ['story_slug' => $item->slug]);
                    $item->author_url = route('client.author', ['author_slug' => $item['author_slug']]);
                    // $item->categories = $listStoryCat[$item->id] ? $listStoryCat[$item->id] : [];
                    
                });
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0, 'data'=> [], 'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'story_id' => ['required', 'exists:stories,id'],
            'point_star' => 'integer|min:1|max:10',
            'content' => 'required|string|min:30|max:500'
        ];
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute ít nhất :min ký tự',
            'max' => ':attribute nhiều nhất :max ký tự',
            'integer' => ':attribute phải là số',
            'exists' => ':attribute không tồn tại',
            'string' => ':attribute phải là một chuỗi'
        ];
    }

    private function attributes()
    {
        return [
            'user_id' => 'Tài khoản',
            'story_id' => 'Tên truyện',
            'point_star' => 'Điểm bình chọn',
            'content' => 'Nội dung đánh giá'
        ];
    }
}
