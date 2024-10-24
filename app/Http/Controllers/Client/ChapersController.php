<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SettingHelpers;
use App\Models\Chaper;
use App\Models\Story;
use App\Models\ViewDay;
use App\Models\ViewMonth;
use App\Models\ViewWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChapersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $story_slug, $chaper_slug)
    {
        $option = SettingHelpers::getInstance();
        $story = Story::getBySlug($story_slug)->first();
        $chaperList = Chaper::selectNotContent()->getByStory($story['id'])->orderBy('position', 'ASC')->get();
        // $chaper = Chaper::getBySlug($chaper_slug)->getByStory($story['id'])->first();
        $chaper = [];
        $linkPrev = '#';
        $linkNext = '#';
        for ($i = 0; $i < count($chaperList); $i++) {
            if ($chaperList[$i]['slug'] == $chaper_slug) {
                $chaper = $chaperList[$i];
                if (!empty($chaperList[$i - 1])) {
                    $linkPrev = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaperList[$i - 1]['slug']]);
                }
                if (!empty($chaperList[$i + 1])) {
                    $linkNext = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaperList[$i + 1]['slug']]);
                }
                break;
            }
            # code...
        }
        $chaper['link'] = route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]);
        $story['link'] = route('client.story', ['story_slug' => $story['slug']]);
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
        $dataView = array(
            'page_title' => ucwords($story['title']) . ' - ' . ucwords($chaper['name']) . ' | ' . $option->getOptionValue('fvn_web_title'),
            'story' => $story,
            'chaper' => $chaper,
            'chaper_list' => $chaperList,
            'link_prev' => $linkPrev,
            'link_next' => $linkNext,
            'breadcrumb' => $breadcrumb
        );
        return view('client_page.chapers', $dataView);
    }

    public function callChapterApi(Request $request, $story_slug, $chaper_slug)
    {
        try {
            $story = Story::getBySlug($story_slug)->first();
            $chaper = Chaper::getBySlug($chaper_slug)->getByStory($story['id'])->first();

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
            $story->update();
            $view_day = ViewDay::getByStory($data['story_id'])->getByKey(get_key_by_day())->first();
            if ($view_day) {
                $view_day->view += 1;
                $view_day->update();
            } else {
                ViewDay::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day()
                ]);
            }

            $view_week = ViewWeek::getByStory($data['story_id'])->getByKey(get_key_by_day('week'))->first();
            if ($view_week) {
                $view_week->view += 1;
                $view_week->update();
            } else {
                ViewWeek::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day('week')
                ]);
            }

            $view_month = ViewMonth::getByStory($data['story_id'])->getByKey(get_key_by_day('month'))->first();
            if ($view_month) {
                $view_month->view += 1;
                $view_month->update();
            } else {
                ViewMonth::create([
                    'story_id' => $data['story_id'],
                    'view' => 1,
                    'key' => get_key_by_day('month')
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => [],
                'message' => 'Tăng lượt view'
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
