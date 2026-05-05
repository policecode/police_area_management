<?php

namespace App\Models;

use App\Enums\PaymentTransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class PayTransaction extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['status_name'];
    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'getway', 'status', 'code']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'getway', 'transaction_date', 'account_number', 'sub_account', 'transfer_type', 'amount', 'money_web', 'code', 'transactions_code', 'status'
    ];

    private $joinUser = false;

    public function getStatusNameAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->status) {
            foreach (PaymentTransactionStatus::asArray() as $key => $item) {
                if ($item['key'] == $this->status) {
                    return $item['display'];
                }
            }
        }
        return '';
    }

    public function scopeJoinUsers($query)
    {
        if ($this->joinUser) {
            return $query;
        }
        $query->select('pay_transactions.*', 'u1.name', 'u1.email')
            ->leftJoin('users AS u1', function ($join) {
                $join->on('pay_transactions.user_id', '=', 'u1.id');
            });

        $this->joinUser = true;
        return $query;
    }
}
