<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class ClientVisitWebsite extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['key']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ip_address', 'count', 'key'
    ];

    private $joinUser = false;

    public function scopeGetByKey($query, $key) {
        $query->where('client_visit_websites.key', $key);
        return $query;
    }
    public function scopeGetByIpAdress($query, $ipAdress) {
        $query->where('client_visit_websites.ip_address', $ipAdress);
        return $query;
    }

    public function scopeGetByUser($query, $userId) {
        $query->where('client_visit_websites.user_id', $userId);
        return $query;
    }

     public function scopeJoinUsers($query)
    {
        if ($this->joinUser) {
            return $query;
        }
        $query->select('client_visit_websites.*', 'u1.name', 'u1.email')
            ->leftJoin('users AS u1', function ($join) {
                $join->on('client_visit_websites.user_id', '=', 'u1.id');
            });

        $this->joinUser = true;
        return $query;
    }
}
