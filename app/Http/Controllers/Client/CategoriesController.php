<?php

namespace App\Http\Controllers\Client;

use App\Enums\TotalChapter;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Category;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    public function index(Request $request, $tag_slug)
    {
        $option = SettingHelpers::getInstance();
        $queryDefault = array(
            'page' => 1,
            'per_page' => 25,
            'order_by' => 'title',
            'order_type' => 'ASC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $category = Category::getBySlug($tag_slug)->first();
        if (!$category) {
            return abort(404);
        }
        $now = Carbon::now();
        $query = Story::getByCategory($category['id'])->joinAuthor();
        $count = $query->count();
        $storyCollection = $query->filter($request)->get();
        $listId = $storyCollection->pluck('id')->toArray();
        $totalChapers = Chaper::getTotalChapers($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now, $totalChapers)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $now->diffInMinutes(new Carbon($item->last_chapers));
            $item->total_chapers = $totalChapers[$item->id];
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Thể loại',
                "url" => ''
            ],
            [
                "title" => $category['name'],
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => ucwords($category['name']).' - '.$option->getOptionValue('fvn_web_title'),
            'category' => $category,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.category', $dataView);
    }

    public function getTotalChapter(Request $request, $slug_total) {
        $option = SettingHelpers::getInstance();
        $queryDefault = array(
            'page' => 1,
            'per_page' => 25,
            'order_by' => 'title',
            'order_type' => 'ASC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $optionChapter = TotalChapter::getTotalChapterByKey($slug_total);
        if (!$optionChapter) {
            return abort(404);
        }
        $query = Chaper::select('stories.*', 'authors.name AS author_name', DB::raw('count(chapers.story_id) AS total_chapter'))
        ->leftJoin('stories', function($join) {
            $join->on('chapers.story_id', '=', 'stories.id');
        })
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        })
        ->groupBy('chapers.story_id')
        ->orderBy($request->order_by, $request->order_type);
        if ($optionChapter['min']) {
            $query->having('total_chapter', '>', (int) $optionChapter['min']);
        }
        if ($optionChapter['max']) {
            $query->having('total_chapter', '<=', (int) $optionChapter['max']);
        }
        $count = $query->count();
        $now = Carbon::now();
        $listStory = $query->skip(($request->page - 1) * $request->per_page)->take($request->per_page)->get()->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $now->diffInMinutes(new Carbon($item->last_chapers));
        })->toArray();

        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Tìm theo số lượng chương',
                "url" => ''
            ],
            [
                "title" => $optionChapter['value'].' chương',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => ucwords($optionChapter['value']).' chương - '.$option->getOptionValue('fvn_web_title'),
            'option_chapter' => $optionChapter,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.totalChapter', $dataView);
    }
   
}
