<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class CoppyrightStory extends Model
{
      use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'story_id']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

     protected $fillable = [
        'user_id',
        'story_id',
    ];

    private $joinUser = false;
    private $joinStory = false;

    public function scopeGetByStory($query, $story_id)
    {
        if (is_array($story_id)) {
            $query->whereIn('coppyright_stories.story_id', $story_id);
        } else {
            $query->where('coppyright_stories.story_id', $story_id);
        }
        return $query;
    }
    public function scopeGetByUser($query, $user_id)
    {
        $query->where('coppyright_stories.user_id', $user_id);
        return $query;
    }

    public function scopeJoinUser($query) {
        if ($this->joinUser ) {
            return $query;
        }
        $query->select('coppyright_stories.*', 'u.id', 'u.name', 'u.email', 'u.avatar')
        ->leftJoin('users AS u', function($join) {
            $join->on('coppyright_stories.user_id', '=', 'u.id');
        });
        $this->joinUser = true;
        return $query;
    }

    public function scopeJoinStory($query) {
        if ($this->joinStory ) {
            return $query;
        }
        $query->select('coppyright_stories.*', 's.title AS story_title', 's.slug AS story_slug', 's.thumbnail', 's.total_chapter', 's.view_count', 'a.name AS author_name', 'a.slug AS author_slug')
        ->leftJoin('stories AS s', function($join) {
            $join->on('coppyright_stories.story_id', '=', 's.id');
        })
        ->leftJoin('authors AS a', function($join) {
            $join->on('s.author_id', '=', 'a.id');
        });
        $this->joinStory = true;
        return $query;
    }
}
