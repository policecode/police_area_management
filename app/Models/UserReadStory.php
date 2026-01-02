<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class UserReadStory extends Model
{
     use HasFactory, Filterable;
    protected $appends = [];
    private $joinStoryChapterAuthor = false;
    private $joinStoryAuthor = false;
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
    public function scopeGetByLastChapter($query) {
        $query->where('user_read_stories.last_chapter_id', '!=', NULL);
        return $query;
    }
    
    public function scopeJoinStoryChapterAuthor($query) {
        if ($this->joinStoryChapterAuthor) {
            return $query;
        }
        $query->select('user_read_stories.*', 's.title as story_title', 's.slug as story_slug', 'c.name as chapter_title', 'c.position as chapter_position', 'a.name as author_name', 'a.slug as author_slug')
        ->leftJoin('stories as s', function($join) {
            $join->on('user_read_stories.story_id', '=', 's.id');
        })
        ->leftJoin('chapers as c', function($join) {
            $join->on('user_read_stories.last_chapter_id', '=', 'c.id');
        })
        ->leftJoin('authors as a', function($join) {
            $join->on('s.author_id', '=', 'a.id');
        }); 

        $this->joinStoryChapterAuthor = true;
        return $query;
    }

    public function scopeJoinStoryAuthor($query) {
        if ($this->joinStoryAuthor) {
            return $query;
        }
        $query->select('user_read_stories.*', 's.title as story_title', 's.slug as story_slug', 's.total_chapter', 's.view_count', 'a.name as author_name', 'a.slug as author_slug')
        ->leftJoin('stories as s', function($join) {
            $join->on('user_read_stories.story_id', '=', 's.id');
        })
        ->leftJoin('authors as a', function($join) {
            $join->on('s.author_id', '=', 'a.id');
        }); 

        $this->joinStoryAuthor = true;
        return $query;
    }
}
