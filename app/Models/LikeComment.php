<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class LikeComment extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'comment_id']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

     protected $fillable = [
        'user_id',
        'comment_id',
        'status'
    ];

    public function scopeGetByStory($query, $story_id)
    {
        $query->where('story_id', $story_id);
        return $query;
    }

    public function scopeGetByComment($query, $comment_id)
    {
        $query->where('comment_id', $comment_id);
        return $query;
    }

    public function scopeGetByUser($query, $user_id)
    {
        $query->where('user_id', $user_id);
        return $query;
    }
}
