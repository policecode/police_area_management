<?php

namespace App\Http\Controllers\Client;

use App\Enums\StatusStory;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\StoryCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = SettingHelpers::getInstance();
        $now = Carbon::now();
        // Truyện hot
        $hot_stories = Story::joinAuthor()->where('star_average', '>', 7)->orderBy('star_average', 'DESC')->skip(0)->take(14)->get()->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $dt = new Carbon($item->created_at); //Tạo 1 datetime
            $item->after_day = $now->diffInDays($dt);;
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // Truyện Mới
        $new_stories = Story::joinAuthor()->orderBy('created_at', 'DESC')->skip(0)->take(15)->get();
        $new_stories = $new_stories->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // Chương truyện mới
        $new_chapters = Story::joinAuthorAndChapter()->orderBy('last_chapers', 'DESC')->skip(0)->take(15)->get();
        // $story_arr= $new_chapter->pluck('id');
        // $listStoryCat = StoryCategory::getListCategoryByStory( $story_arr);
        $new_chapters = $new_chapters->each(function ($item, $key) use ($now) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->after_day = $now->diffInDays(new Carbon($item->created_at));
            $item->after_minutes = $now->diffInMinutes(new Carbon($item->last_chapers));
            // $item->categories = $listStoryCat[$item->id] ? $listStoryCat[$item->id] : [];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // Truyện đã hoàn thành

        $full_stories_collection = Story::joinAuthor()->where('status', StatusStory::FULL['key'])->inRandomOrder()->orderBy('id', 'DESC')->skip(0)->take(14)->get();
        $full_stories = $full_stories_collection->each(function ($item, $key) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // Truyện convert
        $convert_stories_collection = Story::where('title', 'LIKE', "%(c)%")->inRandomOrder()->orderBy('id', 'DESC')->skip(0)->take(16)->get();
        $convert_stories = $convert_stories_collection->each(function ($item, $key) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
        })->toArray();
        $dataView = array(
            'page_title' => $option->getOptionValue('fvn_web_title').' - Trang chủ',
            'hot_stories' => $hot_stories,
            'new_stories' => $new_stories,
            'new_chapters' => $new_chapters,
            'full_stories' => $full_stories,
            'convert_stories' => $convert_stories
        );

        return view('client_page.home', $dataView);
    }

    public function searchKeyword(Request $request)
    {
        try {
            if (!((int)$request->per_page > 0)) {
                return response()->json([
                    'result' => 1,
                    'data' => [],
                    'total' => 0
                ]);
            }
            // DB::enableQueryLog();
            $request->merge([
                'keyword' => Str::slug($request->keyword, " ")
            ]);
            $query = Story::filter($request);
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
            ];
            if ($request->keyword) {
                $query->searchByAuthor($request->keyword);
            }
            if ($request->cat_id) {
                $query->getByCategory($request->cat_id);
            }

            $now = Carbon::now();
            $res['data'] = $query->get()->each(function ($item, $key) use($now) {
                $item->thumbnail = route('index') . '/' . $item->thumbnail;
                $item->url = route('client.story', ['story_slug' => $item->slug]);

                $dt = new Carbon($item->created_at); //Tạo 1 datetime
                $item->after_day = $now->diffInDays($dt);;
            });
            // dd(DB::getQueryLog());
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

   
}
