<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView = array(
            'page_title' => 'Quản lý truyện',
        );
       
        return view('admin_page.stories.lists', $dataView);
    }
    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));
      $query = Story::filter($request);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getthumbnail(Request $request) {
           // $images = Storage::disk('public')->put('example.txt', 'Anh Là Nguyễn Hoàng Đạt');
        // $images = $request->file('thumbnail')->store('stories/thumbnail');
        //  asset('storage/photos/131622436_2878115665801114_8573924252147972299_n.jpg')
        // $contents = Storage::url('example.txt');
        // $file = $request->hasFile('thumbnail');
        // Tạo ảnh cục bộ, phòng ngừa bị download
        return Storage::get('photos/3DVeDHCK808EGGEAfQV90ePa1PUrnf650WLOV7Fu.jpg');
    }

    public function toolUploadStory(Request $request) {
        
        return response()->json( $request->all() );
    }
    public function toolUploadChaper(Request $request) {
        return response()->json('Nguyễn Hoàng Đạt');
    }
}
