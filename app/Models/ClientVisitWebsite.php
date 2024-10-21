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

    public function scopeGetByKey($query, $key) {
        $query->where('key', $key);
        return $query;
    }
    public function scopeGetByIpAdress($query, $ipAdress) {
        $query->where('ip_address', $ipAdress);
        return $query;
    }
}
