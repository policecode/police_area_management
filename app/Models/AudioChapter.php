<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class AudioChapter extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = []; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chapter_id', 'file_path', 'file_size', 'duration', 'status', 'listen_count'
    ];
    private $joinChapter = false;

    public function scopeGetByStatus($query, $status) {
        $query->where('status', $status);
        return $query;
    }

    public function scopeJoinChapter($query) {
        if ($this->joinChapter) {
            return $query;
        }
        $query->select('audio_chapters.*', 'chapers.story_id', 'chapers.name', 'chapers.slug', 'chapers.content')
        ->leftJoin('chapers', function($join) {
            $join->on('chapers.id', '=', 'audio_chapters.chapter_id');
        });
        $this->joinChapter = true;
        return $query;
    }
}
