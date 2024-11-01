<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Author;
use App\Models\Chaper;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $request->merge(array_merge($queryDefault, $request->query()));
        // $author = Author::getBySlug($author_slug)->first();
        if (!$request->keyword) {
            return redirect(route('index'));
        }
        $now = Carbon::now();
        $query = Story::filter($request)->joinAuthor();
        $count = $query->getTotal();
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

   
}
