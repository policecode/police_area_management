<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Author;
use App\Models\Story;
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
            'per_page' => 25,
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
                "title" => 'Tác giả',
                "url" => ''
            ],
            [
                "title" => $author['name'],
                "url" => ''
            ]
        ];

          // Title Header
          $page_title = 'Danh Sách Truyện Của Tác Giả '.ucwords($author['name']).' Không Nên Bỏ Qua';
     
          // Desccription Header
          $description = str_replace('<br />',' ', $author['description']);
          $arrDesc = explode(' ', $description, 230);
          unset($arrDesc[229]);
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
