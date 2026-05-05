<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderChapter;
use Illuminate\Http\Request;

class OrderChapterController extends Controller
{
        public function index()
    {
        $dataView = array(
            'page_title' => 'Quản Lý Đơn Hàng Chương Truyện',
        );
        return view('admin_page.order_chapters.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));

      try {
        //code...
        $query = OrderChapter::JoinUserStoryChapter()->filter($request);
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
            $res['data'] = $query->get()->each(function ($item, $key) {
                $item->url_story = route('client.story', ['story_slug' => $item->story_slug]);
                $item->url_chapter = route('client.chaper', ['story_slug' => $item->story_slug, 'chaper_position' => $item->chapter_position]);
            });
        }
        return response()->json($res);
      } catch (\Throwable $e) {
        return response()->json([
            'result' => 0, 'data'=> [], 'message' => $e->getMessage()
        ], 400);
      }
  }

  public function destroy(OrderChapter $orderChapter)
    {
        try {
            $status = $orderChapter->delete();
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
}
