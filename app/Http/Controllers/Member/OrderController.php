<?php

namespace App\Http\Controllers\Member;

use App\Enums\PaymentTransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\OrderChapter;
use App\Models\PayTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

      public function historyOrders(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
            'order_by' => 'created_at',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
        $query = OrderChapter::JoinUserStoryChapter()->GetByUser(Auth::id())->GetByStory($request->story_id)->GetByChapter($request->chapter_id);
        $count = $query->count();
        $collection = $query->filter($request)->get()->each(function ($item, $key) {
            $isResult = strpos($item['story_title'], '(c)');
            if ($isResult) {
                $item->is_convert = true;
            } else {
                $item->is_convert = false;
            }
        });
        // dd($collection->toArray());
        $breadcrumb = [
            [
                "title" => "Trình quản trị",
                "url" => route('member.profile_detail', [])
            ],
            [
                "title" => 'Lịch sử mua chương',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Lịch sử mua chương',
            'description' => 'Thông tin các lần mua chương',
            'records' => $collection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
            'breadcrumb' => $breadcrumb
        );
        // dd($dataView);
        return view('member_profile.profile_history_orders', $dataView);
    }

    public function historyPayments(Request $request)
    {
        $queryDefault = array(
            'page' => 1,
            'per_page' => 20,
            'order_by' => 'transaction_date',
            'order_type' => 'DESC'
        );
        $request->merge(array_merge($queryDefault, $request->query()));
         $query = PayTransaction::JoinUsers()->GetByUser(Auth::id())->GetByStatus(PaymentTransactionStatus::SUCCESS['key']);
        $count = $query->count();
        $collection = $query->filter($request)->get()->each(function ($item, $key) {
            
        });
        // dd($collection->toArray());
        $breadcrumb = [
            [
                "title" => "Trình quản trị",
                "url" => route('member.profile_detail', [])
            ],
            [
                "title" => 'Lịch sử nap Linh Thạch',
                "url" => ''
            ]
        ];
        $dataView = array(
            'page_title' => 'Lịch sử nap Linh Thạch',
            'description' => 'Thông tin các lần nap Linh Thạch',
            'records' => $collection,
            'total_records' => $count,
            'per_page' => $request->per_page,
            'page' => $request->page,
            'breadcrumb' => $breadcrumb
        );
        // dd($dataView);
        return view('member_profile.profile_history_payments', $dataView);
    }
}
