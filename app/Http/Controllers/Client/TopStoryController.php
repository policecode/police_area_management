<?php

namespace App\Http\Controllers\Client;

use App\Enums\StatusStory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TopStoryController extends Controller
{
    public function newUpdateStory(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 12,
            'order_by' => 'last_chapers',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
      
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            // $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Truyện mới cập nhật',
                "url" => route('client.new-update')
            ]
        ];

        // Title Header
        $page_title = 'Danh Sách Truyện Mới';
        
         // Desccription Header
         $description = 'Trạng thái cập nhật các bộ truyện mới nhất';
        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.top_story', $dataView);
    }

    public function hotStory(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 12,
            'order_by' => 'last_chapers',
            'order_type' => 'DESC',
            'star_average_min' => 7
        );
        $request->merge(array_merge($queryDefault, $request->query()));
      
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            // $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Truyện Hay',
                "url" => route('client.hot-story')
            ]
        ];

        // Title Header
        $page_title = 'Danh Sách Truyện Hot';
        
         // Desccription Header
         $description = 'Các bộ truyện đang được độc giả yêu thích';
        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.top_story', $dataView);
    }

    public function fullStory(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 12,
            'order_by' => 'last_chapers',
            'order_type' => 'DESC',
            'status' => StatusStory::FULL['key']
        );
        $request->merge(array_merge($queryDefault, $request->query()));
      
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            // $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Hoàn Thành',
                "url" => route('client.full-story')
            ]
        ];

        // Title Header
        $page_title = 'Danh Sách Truyện Full';
        
         // Desccription Header
         $description = 'Danh sách các bộ truyện đã ra hết';
        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.top_story', $dataView);
    }

    public function viewStory(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 12,
            'order_by' => 'view_count',
            'order_type' => 'DESC',
            'view_count_min' => 100
        );
        $request->merge(array_merge($queryDefault, $request->query()));
      
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers?$now->diffInMinutes(new Carbon($item->last_chapers)):$now->diffInMinutes(new Carbon($item->created_at));
            // $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // dd($listStory);
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Xem nhiều',
                "url" => route('client.full-story')
            ]
        ];

        // Title Header
        $page_title = 'Danh Sách Truyện Được Xem Nhiều';
        
         // Desccription Header
         $description = 'Danh sách các bộ truyện được xem nhiều nhất của Truyện Full Việt';
        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.top_story', $dataView);
    }

}
