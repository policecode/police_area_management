<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class ViewWeek extends Model
{
    use HasFactory, Filterable;
    public $filterKeywords = ['story_id', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['story_id', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id', 'view', 'key'
    ];
    public $timestamps = false;
    private $joinStory = false;
    public function scopeGetByStory($query, $story_id) {
        $query->where('story_id', $story_id);
        return $query;
    }
    public function scopeGetByKey($query, $key) {
        $query->where('key', $key);
        return $query;
    }

    public function scopeJoinStory($query) {
        if ($this->joinStory ) {
            return $query;
        }
        $query->select('stories.*', 'view_weeks.view', 'view_weeks.key', 'view_days.key', 'authors.name AS author_name', 'authors.slug AS author_slug')
        ->leftJoin('stories', function($join) {
            $join->on('view_weeks.story_id', '=', 'stories.id');
        })
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        });
        $this->joinStory = true;
        return $query;
    }
}
