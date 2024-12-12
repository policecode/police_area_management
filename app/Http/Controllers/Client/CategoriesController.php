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
        $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now, $totalChapers, $allCategoriesOfStory)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            $item->total_chapers = empty($totalChapers[$item->id])?0:$totalChapers[$item->id];
            $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            // [
            //     "title" => 'Thể loại',
            //     "url" => ''
            // ],
            [
                "title" => $category['name'],
                "url" => route('client.tag', ['tag_slug' => $tag_slug])
            ]
        ];

        // Title Header
        $page_title = 'Danh Sách Truyện '.ucwords($category['name']).' Hay - Thể Loại '.ucwords($category['name']).' Không Nên Bỏ Qua';
        
         // Desccription Header
         $description = str_replace('<br />',' ', $category['description']);
         $arrDesc = explode(' ', $description, 50);
         unset($arrDesc[49]);
         $newArrDesc = array_filter($arrDesc, function($value) {
             return $value;
         });
         $description = implode(' ', $newArrDesc);
        $dataView = array(
            'page_title' => $page_title,
            'category' => $category,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
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
        $optionChapter = TotalChapter::getTotalChapterByKey($slug_total);
        if ($optionChapter['min']) {
            $queryDefault['total_chapter_min'] = $optionChapter['min'];
        }
        if ($optionChapter['max']) {
            $queryDefault['total_chapter_max'] = $optionChapter['max'];
        }
        $request->merge(array_merge($queryDefault, $request->query()));
        if (!$optionChapter) {
            return abort(404);
        }

        $query = Story::filter($request)->joinAuthor();
        $now = Carbon::now();
        $listStory = $query->get()->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $now->diffInMinutes(new Carbon($item->last_chapers));
        })->toArray();
        // dd($listStory);

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
                "title" => $optionChapter['value'],
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => ucwords($optionChapter['value']).' chương - '.$option->getOptionValue('fvn_web_title'),
            'option_chapter' => $optionChapter,
            'records' => $listStory,
            'total_records' => $query->getTotal(),
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.totalChapter', $dataView);
    }
   
}
