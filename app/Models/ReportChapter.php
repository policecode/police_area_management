<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class ReportChapter extends Model
{
    use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = ['content']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'story_id', 'chapter_id', 'status']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    protected $fillable = [
        'user_id',
        'story_id',
        'chapter_id',
        'content',
        'status'
    ];

     public function scopeGetByUser($query, $user_id) {
        $query->where('report_chapters.user_id', $user_id);
        return $query;
    }

    public function scopeGetByStory($query, $story_id) {
        if (is_array($story_id)) {
            $query->whereIn('report_chapters.story_id', $story_id);
        } else {
            $query->where('report_chapters.story_id', $story_id);
        }
        return $query;
    }

    public function scopeGetByChapter($query, $chapter_id) {
        $query->where('report_chapters.chapter_id', $chapter_id);
        return $query;
    }

    public function scopeGetByStatus($query, $status) {
        $query->where('report_chapters.status', $status);
        return $query;
    }
}
