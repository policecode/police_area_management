<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Author;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $author_slug)
    {
        $option = SettingHelpers::getInstance();
        $queryDefault = array(
            'page' => 1,
            'per_page' => 100,
            'order_by' => 'title',
            'order_type' => 'ASC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $author = Author::getBySlug($author_slug)->first();
        if (!$author) {
            return abort(404);
        }
        $now = Carbon::now();
        $query = Story::getByAuthor($author['id']);
        $count = $query->count();
        $storyCollection = $query->filter($request)->get();
        $listId = $storyCollection->pluck('id')->toArray();
        $allCategoriesOfStory = StoryCategory::getListCategoryByStory($listId);
        $listStory = $storyCollection->each(function ($item, $key) use ($now, $allCategoriesOfStory)  {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
             $item->categories = empty($allCategoriesOfStory[$item->id])?[]:$allCategoriesOfStory[$item->id];
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
            // [
            //     "title" => 'Tác giả',
            //     "url" => ''
            // ],
            [
                "title" => $author['name'],
                "url" => route('client.author', ['author_slug' => $author_slug])
            ]
        ];

          // Title Header
          $page_title = 'Danh Sách Truyện Của Tác Giả '.ucwords($author['name']).' Không Nên Bỏ Qua';
     
          // Desccription Header
          $description = str_replace('<br />',' ', $author['description']);
          $arrDesc = explode(' ', $description, 50);
          unset($arrDesc[49]);
          $newArrDesc = array_filter($arrDesc, function($value) {
              return $value;
          });
          $description = implode(' ', $newArrDesc);

        $dataView = array(
            'page_title' => $page_title,
            'author' => $author,
            'records' => $listStory,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' =>$request->page,
            'breadcrumb' => $breadcrumb,
            'description' => $description
        );
        return view('client_page.author', $dataView);
    }

   
}
