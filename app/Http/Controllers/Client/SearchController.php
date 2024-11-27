<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Author;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $option = SettingHelpers::getInstance();
        $queryDefault = array(
            'page' => 1,
            'per_page' => 25,
            'order_by' => 'title',
            'order_type' => 'ASC'
        );
        $request->merge(array_merge($queryDefault, $request->query(), [
            'keyword' => Str::slug($request->keyword, " ")
        ]));
    
        // $author = Author::getBySlug($author_slug)->first();
        if (!$request->keyword) {
            return redirect(route('index'));
        }
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        if ($request->keyword) {
            $query->searchByAuthor($request->keyword);
        }
        $count = $query->count();
        $storyCollection = $query->get();
        $listId = $storyCollection->pluck('id')->toArray();
        $totalChapers = Chaper::getTotalChapers($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now, $totalChapers)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            $item->total_chapers = empty($totalChapers[$item->id])?0:$totalChapers[$item->id];
        })->toArray();
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Tìm kiếm',
                "url" => ''
            ],
            [
                "title" => $request->keyword,
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Tìm kiếm với từ khóa: '.$request->keyword.' - '.$option->getOptionValue('fvn_web_title'),
            'keyword' => $request->keyword,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.search', $dataView);
    }

    public function superSearch(Request $request) {
        $option = SettingHelpers::getInstance();
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Tìm kiếm nâng cao',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Tìm kiếm nâng cao - '.$option->getOptionValue('fvn_web_title'),
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.super_search', $dataView);
    }

    public function searchItem(Request $request) {
        $listCategory = $request->cats;
        $request->merge([
            'keyword' => Str::slug($request->keyword, " ")
        ]);
        $query = Story::with('categories')->filter($request->except(['cats']))->joinAuthor();
        if ($listCategory) {
            foreach ($listCategory as $key => $cat) {
                $listStoryId = StoryCategory::select('story_id')->getByCategoryId($cat)->get()->pluck('story_id')->toArray();
                $query->whereIn('stories.id', $listStoryId);
            }
        }
        $res = [
            'result' => 1,
            'data' => [],
            'page' => $request->page,
            'per_page' => $request->per_page,
            'total' => 0
        ];
        if($request->is_paginate){
            $res['total'] = $query->count();
        }else{
            $listStories = $query->get();
            $totalChapers = Chaper::getTotalChapers($listStories->pluck('id'));
            $now = Carbon::now();
            $res['data'] = $listStories->each(function ($item, $key) use ($now, $totalChapers)  {
                $item->thumbnail = route('index') . '/' . $item->thumbnail;
                $item->url =  route('client.story', ['story_slug' => $item->slug]);
                $item->after_day = $now->diffInDays(new Carbon($item->created_at));
                $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
                $item->total_chapers = empty($totalChapers[$item->id])?0:$totalChapers[$item->id];
            })->toArray();
        }
        return response()->json($res);
    }

   
}
