<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class ReplaceContent extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = [ ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['story_id']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id', 'old_content', 'new_content'
    ];
    public $timestamps = false;

     public function scopeGetByStory($query, $story_id) {
        if (is_array($story_id)) {
            $query->whereIn('story_id', $story_id);
        } else {
            $query->where('story_id', $story_id);
        }
        return $query;
    }
    public function scopeGetByOldContent($query, $content) {
 
        $query->where('old_content', $content);
        return $query;
    }

    public function scopeGetByNewContent($query, $content) {
 
        $query->where('new_content', $content);
        return $query;
    }

}
