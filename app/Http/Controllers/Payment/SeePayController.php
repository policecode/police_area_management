<?php

namespace App\Http\Controllers\Payment;

use App\Enums\MoneyToCoint;
use App\Enums\PaymentTransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\PayTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use App\Models\User;
// use Illuminate\Support\Facades\Validator;

class SeePayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['handleWebhook']);
    }

    public function index()
    {
        // return 'hello';
        $dataView = array(
            'page_title' => 'Nạp linh thạch',
            'description' => 'Linh thạch dùng để mua các chương công pháp đã khóa'
        );
        return view('member_profile.payment', $dataView);
    }

    public function getQrCode(Request $request)
    {
        try {
            $check_amount = MoneyToCoint::getItemByKey($request->amount_key);
            if (!$check_amount) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Mệnh giá không khả dụng'
                ]);
            }
            $amount = $check_amount['money'];
            $user = auth()->user();
            $code = $this->getTransactionCode($request->amount_key);
            $bank = env('BANK_SEPAY');
            $acc = env('ACC_SEPAY');
            $money_web = $check_amount['value'];
            $payTransaction = PayTransaction::create([
                'user_id' => $user->id,
                'getway' => $bank,
                'account_number' => $acc,
                'amount' => $amount,
                'money_web' => $money_web,
                'code' => $code,
            ]);
            $res = [
                'status' => 1,
                'qr_code' => "https://qr.sepay.vn/img?acc=$acc&bank=$bank&amount=$amount&des=$code&template=compact&download=true",
                'bank' => env('BANK_NAME_SEPAY'),
                'acc_name' => env('NAME_SEPAY'),
                'acc_number' => $acc,
                'amount' => currency_format($amount),
                'money_web' => currency_format($money_web, ''),
                'code' => $code,
                'pay_transaction' => $payTransaction
            ];
            return response()->json($res);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function checkPaymentStatus(Request $request)
    {
        try {
            $code = $request->code;
            $transaction = PayTransaction::where('code', $code)->first();
            if (!$transaction) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Giao dịch không tồn tại'
                ]);
            }
            // Trả về trang thái giao dịch
            return response()->json([
                'status' => 1,
                'result' => $transaction
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function handleWebhook(Request $request)
    {
        $test = "MBVCB.14012227537.577093.WZ1777529573M1A1ZW.CT tu 1021005659 NGUYEN HOANG DAT toi 0961555152 NGUYEN HOANG DAT tai MB- Ma GD ACSP/ tq577093";
        
       
        
        

        // 1. Kiểm tra API Key từ Header
        $apiKey = $request->header('Authorization');
        $expectedKey = "Apikey " . env('API_KEY_SEPAY'); // Lưu key trong file .env

        if ($apiKey !== $expectedKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } 
        DB::beginTransaction();
        try {
            $pattern = '/(HZ.*?ZW)/';
            preg_match($pattern, $request->content, $matches);
            $code = $matches[0];
            $transaction = PayTransaction::where('code', $code)->first();
            if (!$transaction) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Giao dịch không tồn tại'
                ]);
            }
            if ($transaction->status == PaymentTransactionStatus::SUCCESS['key']) {
                return response()->json([
                   'success' => false,
                   'message' => 'Giao dịch đã được xử lý'
               ]);
            } else {
                // Phải ở trạng thái nạp tiền mới xử lý
                if (Str::lower($request->transferType)  == 'in') {
                    // Cập nhật trạng thái giao dịch
                    $transaction->status = PaymentTransactionStatus::SUCCESS['key'];
                    $transaction->transactions_code = $request->id;
                    $transaction->transaction_date = $request->transactionDate;
                    $transaction->transfer_type = $request->transferType;
                    $transaction->account_number = $request->accountNumber;
                    $transaction->sub_account = $request->subAccount;

                    $transaction->save();
                    // Nạp tiền vào tài khoản người dùng
                    $user = User::find($transaction->user_id);
                    $user->money += $transaction->money_web;
                    $user->save();
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Giao dịch không hợp lệ'
                    ]);
                }
            }
            // Trả về trang thái giao dịch
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Giao dịch đã được xử lý thành công'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function getTransactionCode($amount_key)
    {
        // Tiền tố (ví dụ: GD là Giao Dịch)
        $prefix_start = "HZ";
        $prefix_end = "ZW";

        // Lấy timestamp hiện tại (đảm bảo tính duy nhất theo thời gian)
        $timestamp = time();
        // Gói giao dịch
        $money = 'M' . $amount_key; // Thêm tiền tố gói giao dịch
        // user id tài khoản giao dịch
        $user = 'A' . auth()->id();
        return $prefix_start . $timestamp . $money . $user.$prefix_end;
    }
}
