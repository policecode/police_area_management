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

        $full_stories_collection = Story::joinAuthorAndChapter()->where('status', StatusStory::FULL['key'])->inRandomOrder()->orderBy('id', 'DESC')->skip(0)->take(6)->get();
        $story_arr = $full_stories_collection->pluck('id');
        $listStoryCat = StoryCategory::getListCategoryByStory($story_arr);
        $full_stories = $full_stories_collection->each(function ($item, $key) use ($listStoryCat) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $item->categories = $listStoryCat[$item->id] ? $listStoryCat[$item->id] : [];
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        // Truyện convert
        $convert_stories_collection = Story::where('title', 'LIKE', "%(c)%")->inRandomOrder()->orderBy('id', 'DESC')->skip(0)->take(9)->get();
        $convert_stories = $convert_stories_collection->each(function ($item, $key) {
            $item->thumbnail = route('index') . '/' . $item->thumbnail;
            $isResult = strpos($item->title, '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        })->toArray();
        $dataView = array(
            'page_title' => $option->getOptionValue('fvn_web_title') . ' - Trang chủ',
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
            $query = Story::filter($request)->joinAuthorAndChapter();
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
            $res['data'] = $query->get()->each(function ($item, $key) use ($now) {
                $item->thumbnail = route('index') . '/' . $item->thumbnail;
                $item->url = route('client.story', ['story_slug' => $item->slug]);
                $item->author_url = route('client.author', ['author_slug' => $item->author_slug]);
                $item->chapterr_url = route('client.chaper', ['story_slug' => $item['slug'], 'chaper_slug' => $item['chaper_slug']]);
                $dt = new Carbon($item->created_at); //Tạo 1 datetime
                $item->after_day = $now->diffInDays($dt);
                $isResult = strpos($item->title, '(c)');
                if ($isResult) {
                    $item->is_convert = true;
                } else {
                    $item->is_convert = false;
                }
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

    public function huongdan(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Hướng Dẫn',
                "url" => route('client.huong-dan')
            ]
        ];
        $dataView = array(
            'page_title' => "Hướng Dẫn",
            'breadcrumb' => $breadcrumb,
        );
        return view('client_page.pages.huong_dan', $dataView);
    }

    public function dieukhoandichvu(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Điều Khoản Dịch Vụ',
                "url" => route('client.huong-dan')
            ]
        ];
        $dataView = array(
            'page_title' => "Điều Khoản Dịch Vụ",
            'breadcrumb' => $breadcrumb,
        );
        return view('client_page.pages.dieu_khoan_dich_vu', $dataView);
    }

    public function banquyen(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Bản Quyền',
                "url" => route('client.ban-quyen')
            ]
        ];
        $dataView = array(
            'page_title' => "Bản Quyền",
            'breadcrumb' => $breadcrumb,
        );
        return view('client_page.pages.ban_quyen', $dataView);
    }

    public function chinhsachbaomat(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Chính sách bảo mật',
                "url" => route('client.chinh-sach-bao-mat')
            ]
        ];
        $dataView = array(
            'page_title' => "Chính Sách Bảo Mật",
            'breadcrumb' => $breadcrumb,
        );
        return view('client_page.pages.chinh_sach_bao_mat', $dataView);
    }

    public function lienhe(Request $request)
    {
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => 'Liên hệ',
                "url" => route('client.lien-he')
            ]
        ];
        $dataView = array(
            'page_title' => "Liên Hệ",
            'breadcrumb' => $breadcrumb,
        );
        return view('client_page.pages.lien_he', $dataView);
    }
}
