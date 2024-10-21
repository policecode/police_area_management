<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientVisitWebsite;
use Illuminate\Http\Request;

class FollowWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataView = array(
            'page_title' => 'Theo dõi số lượng truy cập',
        );
        return view('admin_page.visit-website.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
        
        if ($request->key) {
            $request->merge(array(
              'key' => get_key_by_day('date', $request->key)
            ));
        } else {
            $request->merge(array(
                'key' => get_key_by_day()
              ));
        }
      try {
        //code...
        $query = ClientVisitWebsite::filter($request);
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
    public function store(Request $request)
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
}
