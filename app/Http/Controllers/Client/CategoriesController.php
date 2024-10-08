<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $tag_slug)
    {
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
        $query = Story::getByCategory($category['id']);
        $count = $query->count();
        $listStory = $query->filter($request)->get()->each(function ($item, $key) use ($now)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
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
            'page_title' => ucwords($category['name']),
            'category' => $category,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.category', $dataView);
    }

   
}
