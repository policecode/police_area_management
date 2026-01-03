<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class TopMemberDay extends Model
{
    use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = ['user_id']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'exp_day',
        'key'
    ];
    public $timestamps = false;
    private $joinUser = false;

    public function scopeGetByUser($query, $user_id)
    {
        if (is_array($user_id)) {
            $query->whereIn('top_member_days.user_id', $user_id);
        } else {
            $query->where('top_member_days.user_id', $user_id);
        }
        return $query;
    }
    public function scopeGetByKey($query, $key)
    {
        $query->where('top_member_days.key', $key);
        return $query;
    }

     public function scopeJoinUser($query) {
        if ($this->joinUser ) {
            return $query;
        }
        $query->select('top_member_days.*', 'u.name', 'u.avatar')
        ->leftJoin('users as u', function($join) {
            $join->on('top_member_days.user_id', '=', 'u.id');
        }); 
        $this->joinUser = true;
        return $query;
    }
}
