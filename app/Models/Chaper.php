<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Chaper extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = ['name', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['name', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug', 'story_id', 'content', 'position', 'view',
    ];

    public function scopeGetByPosition($query, $position) {
        $query->where('position', $position);
        return $query;
    }
    public function scopeGetByStory($query, $story_id) {
        $query->where('story_id', $story_id);
        return $query;
    }
}
