<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayTransaction;
use Illuminate\Http\Request;

class PayTransactionController extends Controller
{
    public function index()
    {
        $dataView = array(
            'page_title' => 'Quản Lý Dòng Tiền Nạp Vào Trang Web',
        );
        return view('admin_page.pay_transaction.lists', $dataView);
    }

    public function getItems(Request $request) {
        // Thêm dữ liệu vào trong query
      // $request->merge(array_merge($queryDefault, $request->query()));

      try {
        //code...
        $query = PayTransaction::JoinUsers()->filter($request);
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

  public function destroy(PayTransaction $payTransaction)
    {
        try {
            $status = $payTransaction->delete();
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
                
