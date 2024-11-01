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

    public function getItems(Request $request) {
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
        if($request->is_paginate){
            $res['total'] = $query->getTotal();
        }else{
            $res['data']  = $query->get();
        }
        return response()->json($res);
      } catch (\Throwable $e) {
        return response()->json([
            'result' => 0, 'data'=> [], 'message' => $e->getMessage()
        ], 400);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $story)
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
                'story_id' => $story,
                'content' => $data['content'],
                'position' => $data['position']
            ]);
            Story::find($story)->update([
                'last_chapers' => Carbon::now(),
                'chaper_id' => $chaper->id
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
                'status' => 0, 'message' => $e->getMessage()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($story, Chaper $chaper)
    {
        try {
            DB::beginTransaction();
            $status = $chaper->delete();
            DB::commit();
            return response()->json([
                'status' => $status, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroyAll($story)
    {
        try {
            DB::beginTransaction();
            $storyColection = Story::find($story);
            $status = Chaper::getByStory($storyColection->id)->delete();
            DB::commit();
            return response()->json([
                'status' => $status, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
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
            $rules['position'] = ['required', 'integer', function($attr, $value, $fail) use($request, $story_id) {
                $chaper = Chaper::getByStory($story_id)->getByPosition($value)->where('id', '!=',$request->id)->first();
                if ($chaper) {
                    $fail('Vị trí này đã được sử dụng');
                }
            }];
        } else {
            $rules['position'] = ['required', 'integer', function($attr, $value, $fail) use($story_id) {
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
}
