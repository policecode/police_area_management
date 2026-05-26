<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class OrderMonth extends Model
{
    use HasFactory, Filterable;
    public $filterKeywords = ['story_id', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['story_id', 'key']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id', 'money', 'key'
    ];
    public $timestamps = false;
    private $joinStory = false;

      public function scopeGetByStory($query, $story_id) {
        if (is_array($story_id)) {
            $query->whereIn('order_months.story_id', $story_id);
        } else {
            $query->where('story_id', $story_id);
        }
        return $query;
    }
    public function scopeGetByKey($query, $key) {
        $query->where('order_months.key', $key);
        return $query;
    }

     public function scopeJoinStory($query) {
        if ($this->joinStory ) {
            return $query;
        }
        $query->select('stories.*', 'order_months.money', 'order_months.key', 'authors.name AS author_name', 'authors.slug AS author_slug')
        ->leftJoin('stories', function($join) {
            $join->on('order_months.story_id', '=', 'stories.id');
        })
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        });
        $this->joinStory = true;
        return $query;
    }
}
