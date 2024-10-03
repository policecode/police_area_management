<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class StoryCategory extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = ['name', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['name', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    private $joinCategory = false;
    protected $fillable = [
        'story_id', 'category_id'
    ];

    public function scopeJoinCategory($query) {
        if ($this->joinCategory ) {
            return $query;
        }
        $query->select('story_categories.story_id', 'categories.*')
        ->leftJoin('categories', function($join) {
            $join->on('story_categories.category_id', '=', 'categories.id');
        });
        $this->joinCategory = true;
        return $query;
    }
}
