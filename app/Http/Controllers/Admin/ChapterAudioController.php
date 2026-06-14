<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AudioStatus;
use App\Http\Controllers\Controller;
use App\Models\AudioChapter;
use App\Models\Chaper;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChapterAudioController extends Controller
{
    public function index(Story $story)
    {
        $dataView = array(
            'page_title' => 'Quản lý chương truyện',
            'story' => $story
        );
        return view('admin_page.stories.lists_audio_chaper', $dataView);
    }

    public function getItems(Request $request)
    {
        // Thêm dữ liệu vào trong query
        // $request->merge(array_merge($queryDefault, $request->query()));
// $chapters = Chaper::select('id')->where('story_id', $request->story_id)->get()->pluck('id')->toArray();
// dd($chapters);
        try {
            // dd($request->all());
            $query = Chaper::JoinAudio()->filter($request);
            $res = [
                'result' => 1,
                'data' => [],
                'page' => $query->getPageNumber(),
                'per_page' => $query->getPerPage(),
                'total' => 0
            ];
            if ($request->is_paginate) {
                $res['total'] = $query->getTotal();
            } else {
                $res['data']  = $query->get()->each(function ($item, $key) {
                    if ($item->status == AudioStatus::PENDING['key']) {
                        $item->status_text = AudioStatus::PENDING['value'];
                    } else if ($item->status == AudioStatus::SUCCESS['key']) {
                        $item->status_text = AudioStatus::SUCCESS['value'];
                    } else {
                        $item->status_text = 'Chưa có audio';
                    }
                    
                    $isResult = strpos($item->title, '(c)');
                    if ($isResult) {
                        $item->is_convert = true;
                    } else {
                        $item->is_convert = false;
                    }
                })->toArray();
            }
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'result' => 0,
                'data' => [],
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Story $story)
    {
        try {
            DB::beginTransaction();

            $chapters_list_id = Chaper::select('id')->where('story_id', $story->id)->get()->pluck('id')->toArray();
            $chapter_audio_list_id = AudioChapter::select('chapter_id')->whereIn('chapter_id', $chapters_list_id)->get()->pluck('chapter_id')->toArray();
            $dataInsert = [];
            $countInsert = 0;
            foreach ($chapters_list_id as $chapter_id) {
                if (!in_array($chapter_id, $chapter_audio_list_id)) {
                    $countInsert++;
                    $dataInsert[] = [
                        'chapter_id' => $chapter_id,
                        'status' => AudioStatus::PENDING['key'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
            }
            AudioChapter::insert($dataInsert);
     

            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Đưa thành công ' . $countInsert . ' chương vào hàng đợi tạo audio'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($story, Chaper $chaper)
    {
        dd($story);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $story, Chaper $chaper)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules($request, $story), $this->messages(), $this->attributes());
            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'errors' => $validator->errors(),
                    'message' => 'validation'
                ]);
            }

            DB::beginTransaction();
            $data = $validator->validated();
            $data['content_length'] = count(explode(" ", $data['content']));
            $chaper->update($data);

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $chaper,
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
