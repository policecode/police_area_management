<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class UserReadStory extends Model
{
     use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = ['content']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'story_id', 'favorite']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    protected $fillable = [
        'user_id',
        'story_id',
        'last_chapter_id',
        'story_count',
        'favorite'
    ];

    public function scopeGetByUser($query, $user_id) {
        $query->where('user_read_stories.user_id', $user_id);
        return $query;
    }
    public function scopeGetByStory($query, $story_id) {
        $query->where('user_read_stories.story_id', $story_id);
        return $query;
    }
    public function scopeGetByFavorite($query, $favorite) {
        $query->where('user_read_stories.favorite', $favorite);
        return $query;
    }
    
}
