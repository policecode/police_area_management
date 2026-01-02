<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class StarRating extends Model
{
    use HasFactory, Filterable;
    protected $appends = [];
    private $joinUser = false;
    private $joinStory = false;

    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'story_id']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    protected $fillable = [
        'user_id', 'story_id', 'ip_address', 'point_star', 'content'
    ];
    public $timestamps = true;

    public function scopeGetByStory($query, $story_id) {
        $query->where('star_ratings.story_id', $story_id);
        return $query;
    }
    public function scopeGetByUser($query, $user_id) {
        $query->where('star_ratings.user_id', $user_id);
        return $query;
    }
    // public function scopeGetByKeydate($query, $keydate) {
    //     $query->where('key_date', $keydate);
    //     return $query;
    // }
    public function scopeGetByIpAdress($query, $keydate) {
        $query->where('ip_address', $keydate);
        return $query;
    }

    public function scopeJoinUser($query) {
        if ($this->joinUser ) {
            return $query;
        }
        $query->select('star_ratings.*', 'u.name')
        ->leftJoin('users as u', function($join) {
            $join->on('star_ratings.user_id', '=', 'u.id');
        }); 

        $this->joinUser = true;

        return $query;
    }

    public function scopeJoinStory($query) {
        if ($this->joinStory ) {
            return $query;
        }
        $query->select('star_ratings.*', 's.title', 's.slug')
        ->leftJoin('stories as s', function($join) {
            $join->on('star_ratings.story_id', '=', 's.id');
        }); 

        $this->joinStory = true;
        return $query;
    }
}
