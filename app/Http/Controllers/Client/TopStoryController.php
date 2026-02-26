<?php

namespace App\Http\Controllers\Client;

use App\Enums\LockStories;
use App\Enums\StatusStory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\ViewDay;
use App\Models\ViewMonth;
use App\Models\ViewWeek;
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
        $query = Story::filter($request)->joinAuthor()->GetByUnLock(LockStories::LOCK['key']);
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers ? $now->diffInMinutes(new Carbon($item->last_chapers)) : $now->diffInMinutes(new Carbon($item->created_at));
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
        $page_title = 'Danh Sách Truyện Mới Cập Nhật';

        // Desccription Header
        $description = 'Trạng thái cập nhật các bộ truyện mới nhất';
        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
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
        $query = Story::filter($request)->joinAuthor()->GetByUnLock(LockStories::LOCK['key']);
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers ? $now->diffInMinutes(new Carbon($item->last_chapers)) : $now->diffInMinutes(new Carbon($item->created_at));
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
            'page' => $request->page,
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
        $query = Story::filter($request)->joinAuthor()->GetByUnLock(LockStories::LOCK['key']);
        $count = $query->getTotal();
        $storyCollection = $query->get();
        // $listId = $storyCollection->pluck('id')->toArray();
        // $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->last_update = $item->last_chapers ? $now->diffInMinutes(new Carbon($item->last_chapers)) : $now->diffInMinutes(new Carbon($item->created_at));
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
            'page' => $request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.top_story', $dataView);
    }

    public function viewStory(Request $request, $view_slug)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 12,
            'order_by' => 'view',
            'order_type' => 'DESC',
        );
        $page_title = '';
        $description = '';
        $query = '';
        if ($view_slug == 'day') {
            $page_title = 'Xem Nhiều Trong Ngày';
            $description = 'Danh Sách Truyện Được Xem Nhiều Trong Ngày';
            $queryDefault['key'] = get_key_by_day('date');
        } elseif ($view_slug == 'week') {
            $page_title = 'Xem Nhiều Trong Tuần';
            $description = 'Danh Sách Truyện Được Xem Nhiều Trong Tuần';
            $queryDefault['key'] = get_key_by_day('week');

        } elseif ($view_slug == 'month') {
            $page_title = 'Xem Nhiều Trong Tháng';
            $description = 'Danh Sách Truyện Được Xem Nhiều Trong Tháng';
            $queryDefault['key'] = get_key_by_day('month');

        }
        $request->merge(array_merge($queryDefault, $request->query()));
          if ($view_slug == 'day') {
            $query = ViewDay::filter($request);
        } elseif ($view_slug == 'week') {
            $query = ViewWeek::filter($request);
        } elseif ($view_slug == 'month') {
            $query = ViewMonth::filter($request);
        }
        $count = $query->getTotal();

        $colection = $query->joinStory()->get();
        $listStory  = $colection->each(function ($item, $key) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();

        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => $page_title,
                "url" => route('client.view-story', ['view_slug' => $view_slug])
            ]
        ];

        $dataView = array(
            'page_title' => $page_title,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description,
            'view_slug' => $view_slug
        );
        return view('client_page.view_story', $dataView);
    }
}
