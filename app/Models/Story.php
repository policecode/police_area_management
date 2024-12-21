<?php

namespace App\Models;

use App\Enums\StatusStory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Story extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['status_name'];
    public $filterKeywords = ['title', 'title_eng']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['title', 'status']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'title_eng', 'slug', 'thumbnail', 'description', 'star_count', 'star_average', 'view_count', 'author_id', 'status', 'created_at', 'updated_at', 'last_chapers', 'chaper_id'
    ];

    private $joinAuthor = false;
    private $joinCategories = false;
    private $joinLastChapers = false;
    private $joinAuthorAndChapter = false;
    public function categories() {
        return $this->belongsToMany(Category::class, 'story_categories', 'story_id', 'category_id');
    }
    public function getStatusNameAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->status) {
            foreach (StatusStory::asArray() as $key => $item) {
                if ($item['key'] == $this->status) {
                    return $item['value'];
                }
            }
        }
        return '';
    }
    public function scopeGetBySlug($query, $slug) {
        $query->where('stories.slug', $slug);
        return $query;
    }
    public function scopeGetByAuthor($query, $author_id) {
        $query->where('stories.author_id', $author_id);
        return $query;
    }

    public function scopeJoinAuthorAndChapter($query) {
        if ($this->joinAuthorAndChapter ) {
            return $query;
        }
        $query->select('stories.*', 'authors.name AS author_name', 'authors.slug AS author_slug', 'chapers.name AS chaper_name', 'chapers.slug AS chaper_slug', 'chapers.position')
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        })
        ->leftJoin('chapers', function($join) {
            $join->on('stories.chaper_id', '=', 'chapers.id');
        });
        $this->joinAuthorAndChapter = true;
        return $query;
    }

    public function scopeJoinAuthor($query) {
        if ($this->joinAuthor ) {
            return $query;
        }
        $query->select('stories.*', 'authors.name AS author_name', 'authors.slug AS author_slug')
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        });
        $this->joinAuthor = true;
        return $query;
    }

    public function scopeJoinCategories($query) {
        if ($this->joinCategories ) {
            return $query;
        }
        $query->select('stories.*', 'story_categories.category_id')
        ->rightJoin('story_categories', function($join) {
            $join->on('stories.id', '=', 'story_categories.story_id');
        });
        $this->joinCategories = true;
        return $query;
    }

    public function scopeJoinChapers($query) {
        if ($this->joinLastChapers ) {
            return $query;
        }
        $query->select('stories.*', 'chapers.name AS chaper_name', 'chapers.slug AS chaper_slug', 'chapers.position')
        ->leftJoin('chapers', function($join) {
            $join->on('stories.chaper_id', '=', 'chapers.id');
        });
        $this->joinLastChapers = true;
        return $query;
    }

    public function scopeSearchByAuthor($query, $author_name) {
        $query->joinAuthor();
        $query->orWhere('authors.name', 'LIKE', '%' . $author_name . '%');
        return $query;
    }

    public function scopeGetByCategory($query, $cat_id) {
        $query->joinCategories();
        $query->where('story_categories.category_id', '=', $cat_id);
        return $query;
    }


}
