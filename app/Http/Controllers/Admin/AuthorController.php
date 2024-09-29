<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView = array(
            'page_title' => 'Quản lý tác giả',
        );
       
        return view('admin_page.author.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));

      try {
        //code...
        $query = Author::filter($request);
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
            $res['data'] = $query->get();
        }
        return response()->json($res);
      } catch (\Throwable $e) {
        return response()->json([
            'result' => 0, 'data'=> [], 'message' => $e->getMessage()
        ], 400);
      }
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        $data = $validator->validated();
        try {
            $result = Author::create($data);
            return response()->json([
                'status' => 1, 
                'data' => $result,
                'message' => 'Create success'
            ]);
        } catch (\Throwable $e) {
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
    public function show(Author $author)
    {
        return response()->json([
            'status' => 1, 
            'data' => $author,
            'message' => 'Get Author'
        ]);
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
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages(), $this->attributes());
        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'errors' => $validator->errors(),
                'message' => 'validation'
            ]);
        }
        $data = $validator->validated();
        try {
    
            $author->update($data);
            return response()->json([
                'status' => 1, 
                'data' => $author,
                'message' => 'Update success'
            ]);
        } catch (\Throwable $e) {
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
    public function destroy(Author $author)
    {
        try {
            $count = Story::select('id')->where('author_id', $author->id)->count();
            if ($count > 0) {
                return response()->json([
                    'status' => 0, 
                    'message' => 'Tác giả đã có tác phẩm, không thể xóa'
                ]);
            }
            $status = $author->delete();
            return response()->json([
                'status' => $status, 
                'message' => 'Delete success'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0, 'message' => $e->getMessage()
            ], 400);
        }
    }

    private function rules($request)
    {
        $rules = [
            'name' => 'required|max:255|unique:authors,name',
            'slug' => 'required|unique:authors,slug',
            'description' => '',
        ];
        if ($request->id) {
            $rules['name'] = 'required|unique:authors,name,'.$request->id;
            $rules['slug'] = 'required|unique:authors,slug,'.$request->id;
      
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
            'name' => 'Tác giả',
            'slug' => 'Đường dẫn tĩnh',
            'email' => 'Email',
            'password' => 'Mật khâu',
            'group_id' => 'Nhóm'
        ];
    }
}
