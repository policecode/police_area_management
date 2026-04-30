<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class OrderChapter extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = [ ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = [ ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'story_id', 'chapter_id', 'money'
    ];

    public function scopeGetByUser($query, $user_id) {
        return $query->where('order_chapters.user_id', $user_id);
    }

    public function scopeGetByStory($query, $story_id) {
        return $query->where('order_chapters.story_id', $story_id);
    }

    public function scopeGetByChapter($query, $chapter_id) {
        return $query->where('order_chapters.chapter_id', $chapter_id);
    }
}
