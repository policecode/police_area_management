<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Story extends Model
{
    use HasFactory, Filterable;
    protected $appends = [];
    public $filterKeywords = ['title', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['title']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'slug', 'thumbnail', 'description', 'star_count', 'star_average', 'view_count', 'author_id', 'status', 'created_at', 'updated_at'
    ];

    private $joinAuthor = false;
    private $joinCategories = false;

    public function categories() {
        return $this->belongsToMany(Category::class, 'story_categories', 'story_id', 'category_id');
    }
    // public function getCategoryAttribute()
    // {
    //     // Không nên dùng attribute để query dữ liệu
    //     if ($this->id) {
    //         $results = StoryCategory::where('story_id', $this->id)->get();

    //         if ($results) {
    //             $tmpCat = [];
    //             foreach ($results as $key => $item) {
    //                 $tmpCat[] = $item->category_id;
    //             }
    //             return $tmpCat;
    //         }
    //     }
    //     return [];
    // }
    public function scopeGetBySlug($query, $slug) {
        $query->where('slug', $slug);
        return $query;
    }

    public function scopeJoinAuthor($query) {
        if ($this->joinAuthor ) {
            return $query;
        }
        $query->select('stories.title', 'stories.slug', 'stories.thumbnail', 'authors.name AS author_name')
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
