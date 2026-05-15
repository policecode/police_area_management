<?php

namespace App\Http\Controllers\Client;

use App\Enums\FavoriteStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Chaper;
use App\Models\OrderChapter;
use App\Models\OrderMonth;
use App\Models\Story;
use App\Models\TopMemberDay;
use App\Models\User;
use App\Models\UserReadStory;
use App\Models\ViewDay;
use App\Models\ViewMonth;
use App\Models\ViewWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChapersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $story_slug, $chaper_position)
    {
        $option = SettingHelpers::getInstance();
        $user = Auth::user();
        $is_admin = false;
        if ($user) {
            if ($user->group->slug == 'admin') {
                $is_admin = true;
            }
        }
        $story = Story::getBySlug($story_slug)->joinAuthor()->first()->toArray();
        $story['link'] = route('client.story', ['story_slug' => $story['slug']]);
        $isResult = strpos($story['title'], '(c)');
        if ($isResult) {
            $story['is_convert'] = true;
        } else {
            $story['is_convert'] = false;
        }
        $chaperList = Chaper::selectNotContent()->getByStory($story['id'])->orderBy('position', 'ASC')->get();
        // Lấy chương truyện theo vị trí
        $chaper = $this->getChapterContent($chaper_position, $story['id']);
  
        // dd($chaper);

        $linkPrev = '#';
        $linkNext = '#';
        for ($i = 0; $i < count($chaperList); $i++) {
            if ($chaperList[$i]['position'] == $chaper_position) {
                if (!empty($chaperList[$i - 1])) {
                    $linkPrev = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $chaperList[$i - 1]['position']]);
                }
                if (!empty($chaperList[$i + 1])) {
                    $linkNext = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $chaperList[$i + 1]['position']]);
                }
                break;
            }
            # code...
        }
        $chaper['link'] = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $chaper['position']]);
        
        // dd($chaper['content_length']);
        if (!$is_admin) {
            $chaper['content'] = $this->addAdsToContent($chaper['content']);
        }
        
        $breadcrumb = [
            [
                "title" => "Trang chủ",
                "url" => route('index', [])
            ],
            [
                "title" => $story['title'],
                "url" => $story['link']
            ],
            [
                "title" => $chaper['name'],
                "url" => $chaper['link']
            ]
        ];
        // dd($chaper['content_length']);
        $dataView = array(
            'page_title' => ucwords($story['title']) . ' - ' . ucwords($chaper['name']) . ' | ' . $option->getOptionValue('fvn_web_title'),
            'story' => $story,
            'chaper' => $chaper,
            'chaper_list' => $chaperList,
            'link_prev' => $linkPrev,
            'link_next' => $linkNext,
            'breadcrumb' => $breadcrumb,
            'is_admin' => $is_admin
        );
        // dd($dataView);
        if ($chaper_position <= 100 || $user) {
            return view('client_page.chapers', $dataView);
        } else {
            return view('client_page.chapers_errors', $dataView);
        }
    }

    private function getChapterContent($chaper_position, $story_id) {
        $chapter = Chaper::getByPosition($chaper_position)->getByStory($story_id)->first();
        if (!($chapter->content_length > 0)) {
            // Cập nhật lại sôt từ của chương
            $chapter->content_length = count(explode(" ", $chapter->content));
            $chapter->update();
        }
        if ($chapter->money > 0) {
            $user = Auth::user();
            if ($user) {
                $orderChapter = OrderChapter::GetByUser($user->id)->GetByChapter($chapter->id)->first();
                if ($orderChapter) {
                    $chapter->unlocked_content = true;

                } else {
                    $chapter->content = mb_substr($chapter->content, 0, 500). '...';
                }
            } else {
                $chapter->content = mb_substr($chapter->content, 0, 500). '...';
            }
        }
        $chapter = $chapter->toArray();
        return $chapter;
    }

    public function buyChapter(Request $request) {
        DB::beginTransaction();
        try {
            if (!Auth::id()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Vui lòng đăng nhập để mua chương'
                ], 400);
            }
            $user = User::find(Auth::id());
            $story = Story::find($request->story_id);
            $chaper = Chaper::getByPosition($request->chaper_position)->getByStory($story->id)->first();
            if (!$chaper) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Chương không tồn tại'
                ], 400);
            }

            $checkerOrderChapter = OrderChapter::GetByUser($user->id)->GetByChapter($chaper->id)->first();
            if ($checkerOrderChapter) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Bạn đã mua chương này rồi'
                ], 400);
            }
         
            if ($user->money < $chaper->money) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Số dư không đủ để mua chương'
                ], 400);
            }
            // Trừ tiền người dùng
            $user->money -= $chaper->money;
            $user->update();
            //  tạo bản ghi mua chương
            OrderChapter::create([
                'user_id' => $user->id,
                'story_id' => $story->id,
                'chapter_id' => $chaper->id,
                'money' => $chaper->money,
            ]);
            // Cập nhật doanh thu cho truyện
            $story->total_money += $chaper->money;
            $story->update();
            // Cập nhật doanh thu của tháng
            $orderMonth = OrderMonth::GetByStory($story->id)->getByKey(get_key_by_day('month'))->first();
            if ($orderMonth) {
                $orderMonth->money += $chaper->money;
                $orderMonth->update();
            } else {
                OrderMonth::create([
                    'story_id' => $story->id,
                    'money' => $chaper->money,
                    'key' => get_key_by_day('month')
                ]);
            }
    
            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Mua chương thành công'
             
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function addAdsToContent($content) {
        $arr = explode(" ", $content);
        $newArr = [];
        for ($i=0; $i < count($arr); $i++) { 
            $newArr[] = $arr[$i];
                if (($i + 1) % 500 == 0) {
                    $newArr[] = ' <span>'.env('KEY_TEXT_CHAPTER').'</span> ';
                }
            }
        return implode(" ", $newArr);
    }

    public function callChapterApi(Request $request, $story_slug, $chaper_position)
    {
        try {
            $story = Story::getBySlug($story_slug)->first();
            $chaper = Chaper::getByPosition($chaper_position)->getByStory($story['id'])->first();

            return response()->json([
                'result' => 1,
                'data' => $chaper
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function increaseViews(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
            $chaper = Chaper::getByStory($data['story_id'])->getById($data['chaper_id'])->first();
            if (!$chaper) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Chương không tồn tại'
                ], 400);
            }
            $story = Story::find($data['story_id']);

            $chaper->view += 1;
            $chaper->update();
            $story->view_count += 1;
            $story->total_percentage = round(($story->view_count/$story->total_chapter) * 100, 2);
            $story->update();
            $view_day = ViewDay::getByStory($data['story_id'])->getByKey(get_key_by_day())->first();
            if ($view_day) {
                $view_day->view += 1;
                $view_day->percentage = round(($view_day->view/$story->total_chapter) * 100, 2);
                $view_day->update();
            } else {
                ViewDay::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day(),
                    'percentage' => round((1/$story->total_chapter) * 100, 2)
                ]);
            }

            $view_week = ViewWeek::getByStory($data['story_id'])->getByKey(get_key_by_day('week'))->first();
            if ($view_week) {
                $view_week->view += 1;
                $view_week->percentage = round(($view_week->view/$story->total_chapter) * 100, 2);
                $view_week->update();
            } else {
                ViewWeek::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day('week'),
                    'percentage' => round((1/$story->total_chapter) * 100, 2)
                ]);
            }

            $view_month = ViewMonth::getByStory($data['story_id'])->getByKey(get_key_by_day('month'))->first();
            if ($view_month) {
                $view_month->view += 1;
                $view_month->percentage = round(($view_month->view/$story->total_chapter) * 100, 2);
                $view_month->update();
            } else {
                ViewMonth::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day('month'),
                    'percentage' => round((1/$story->total_chapter) * 100, 2)
                ]);
            }
            // Xử lý khi đã đăng nhập
            $message = 'Đăng nhập để bắt đầu tu luyện';
            if (Auth::id()) {
                $message = '+1 exp';
                $user = User::find(Auth::id());
                $user->exp += 1;
                if ($user->exp >= $user->level_info['next_exp']) {
                    $user->level += 1;
                }
                $user->total_chapter += 1;
                // Cập nhật bảng user_read_stories
                $userReadStory = UserReadStory::GetByUser($user->id)->GetByStory($data['story_id'])->first();
                if ($userReadStory) {
                    $userReadStory->last_chapter_id = $data['chaper_id'];
                    $userReadStory->story_count += 1;
                    $userReadStory->update();
                } else {
                    UserReadStory::create([
                        'user_id' => $user->id,
                        'story_id' => $data['story_id'],
                        'last_chapter_id' => $data['chaper_id'],
                        'story_count' => 1,
                        'favorite' => FavoriteStatus::NOTINTERESTED['id']
                    ]);
                    $user->total_story += 1;
                }
                $user->update();
                // Cập nhật bảng kinh nghiệm theo ngày
                $topMemberDay = TopMemberDay::GetByUser($user->id)->getByKey(get_key_by_day())->first();
                if ($topMemberDay) {
                    $topMemberDay->exp_day += 1;
                    $topMemberDay->update();
                } else {
                    TopMemberDay::create([
                        'user_id' => $user->id,
                        'exp_day' => 1,
                        'key' => get_key_by_day()
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => [],
                'message' => $message
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'story_id' => 'required',
            'chaper_id' => 'required',
        ];
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute thấp nhất :min điểm',
            'max' => ':attribute cao nhất :max điểm',
            'integer' => ':attribute phải là số',
            'exists' => ':attribute không tồn tại'
        ];
    }

    private function attributes()
    {
        return [
            'story_id' => 'Tên truyện',
            'chaper_id' => 'Tên chương',
        ];
    }
}
