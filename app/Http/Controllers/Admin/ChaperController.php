<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chaper;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Str;

class ChaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Story $story)
    {
        $dataView = array(
            'page_title' => 'Quản lý chương truyện',
            'story' => $story
        );
        return view('admin_page.stories.lists_chaper', $dataView);
    }

    public function getItems(Request $request)
    {
        // Thêm dữ liệu vào trong query
        // $request->merge(array_merge($queryDefault, $request->query()));

        try {
            //code...
            $query = Chaper::filter($request);
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
                $res['data']  = $query->get();
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
            $user = Auth::user();
            $chaper = Chaper::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'story_id' => $story->id,
                'content' => $data['content'],
                'position' => $data['position']
            ]);
            $total_chapter = $story->total_chapter + 1;
            $story->update([
                'last_chapers' => Carbon::now(),
                'chaper_id' => $chaper->id,
                'total_chapter' => $total_chapter
            ]);

            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => $chaper,
                'message' => 'Create success'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story, Chaper $chaper)
    {
        try {
            DB::beginTransaction();
            $status = $chaper->delete();
            if ($status) {
                $total_chapter = $story->total_chapter - 1;
                $story->update([
                    'chaper_id' => Chaper::getByStory($story->id)->orderBy('position', 'DESC')->first()->id,
                    'total_chapter' => $total_chapter
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => $status,
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroyAll(Story $story)
    {
        try {
            DB::beginTransaction();
            $storyColection = Story::find($story->id);
            $status = Chaper::getByStory($storyColection->id)->delete();
            $story->update([
                'last_chapers' => NULL,
                'chaper_id' => NULL,
                'total_chapter' => 0
            ]);
            DB::commit();
            return response()->json([
                'status' => $status,
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request, $story_id)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'content' => '',
        ];
        if ($request->id) {
            $rules['position'] = ['required', 'integer', function ($attr, $value, $fail) use ($request, $story_id) {
                $chaper = Chaper::getByStory($story_id)->getByPosition($value)->where('id', '!=', $request->id)->first();
                if ($chaper) {
                    $fail('Vị trí này đã được sử dụng');
                }
            }];
        } else {
            $rules['position'] = ['required', 'integer', function ($attr, $value, $fail) use ($story_id) {
                $chaper = Chaper::getByStory($story_id)->getByPosition($value)->first();
                if ($chaper) {
                    $fail('Vị trí này đã được sử dụng');
                }
            }];
        }
        return $rules;
    }

    private function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải từ :min ký tự',
            'integer' => ':attribute phải là số'
        ];
    }

    private function attributes()
    {
        return [
            'name' => 'Thông tin chương truyện',
            'slug' => 'Đường dẫn tĩnh',
            'email' => 'Email',
            'author_id' => 'Tác giả',
            'position' => 'Vị trí chương truyện',
            'content' => 'Nội dung chương truyện'
        ];
    }

    public function uploadChapterByWord(Request $request, Story $story)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            if ($request->hasFile('fvn_list_word')) {
                $files = $request->file('fvn_list_word');
                $data = [];
                $dataInsert = [];
                $listPosition = [];
                foreach ($files as $key => $file) {
                    $position = (int) explode('.', $file->getClientOriginalName())[0];
                    $listPosition[] = $position;
                    $tmpPath = $file->getPathname();
                    $resultArr = $this->readFileWord($tmpPath);
                    $data[] = array_merge([
                        'position' => $position,
                        'user_id' => $user->id,
                        'story_id' => $story->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ], $resultArr);
                }

                $resultChapers = Chaper::getByStory($story->id)->whereIn('position', $listPosition)->get();
                foreach ($data as $key => $chapter) {
                    $flag = true;
                    if (count($resultChapers) > 0) {
                        foreach ($resultChapers as $k => $obj) {
                            if ($obj->position == $chapter['position']) {
                                $flag = false;
                            }
                        }
                    }
                    # code...
                    if ($flag) {
                        $dataInsert[] = $chapter;
                    }
                }
                if (count($dataInsert) > 0) {
                    $result = Chaper::insert($dataInsert);
                    $last_record = Chaper::orderBy('id', 'DESC')->first();
                    if ($story->total_chapter) {
                        $total_chapter = $story->total_chapter + count($dataInsert);
                    } else {
                        $total_chapter = count($dataInsert);
                    }
                    $story->last_chapers = Carbon::now();
                    $story->chaper_id = $last_record->id;
                    $story->total_chapter = $total_chapter;
                    $story->update();
                }
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'data' => [],
                    'message' => 'Add '.count($dataInsert).' Chapter'
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function readFileWord($pathFile)
    {
        $arrStr = [];
        // Đọc file .docx
        $phpWord = IOFactory::load($pathFile);
        // Lấy tất cả các section trong tài liệu
        $sections = $phpWord->getSections();

        // Duyệt qua từng section để lấy nội dung
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                // Kiểm tra xem phần tử có phải là text run không
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    // Lấy các phần tử con của text run
                    $textElements = $element->getElements();
                    $str = '';
                    foreach ($textElements as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $str = $str . $textElement->getText() . " ";
                        }
                    }
                    $arrStr[] = $str.'<br/>';
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $arrStr[] = $element->getText().'<br/>';
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Title) {
                    $textElement = $element->getText().'<br/>';
                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $arrStr[] = $textElement->getText().'<br/>';
                    } else {
                        $arrStr[] = $textElement.'<br/>';
                    }
                }
            }
        }
        $title = $arrStr[0];
        unset($arrStr[0]);
        return [
            'name' => $title,
            'slug' => Str::slug($title, "-"),
            'content' => implode('<br/>', $arrStr)
        ];
    }
}
