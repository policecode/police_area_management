<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class StarRating extends Model
{
    use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = []; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    protected $fillable = [
        'user_id', 'story_id', 'ip_address', 'point_star', 'key_date'
    ];
    public $timestamps = false;

    public function scopeGetByStory($query, $story_id) {
        $query->where('story_id', $story_id);
        return $query;
    }
    public function scopeGetByUser($query, $user_id) {
        $query->where('user_id', $user_id);
        return $query;
    }
    public function scopeGetByKeydate($query, $keydate) {
        $query->where('key_date', $keydate);
        return $query;
    }
    public function scopeGetByIpAdress($query, $keydate) {
        $query->where('ip_address', $keydate);
        return $query;
    }
}
