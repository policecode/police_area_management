<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Story extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['category'];
    public $filterKeywords = ['title', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['title', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'slug', 'thumbnail', 'description', 'star_count', 'star_average', 'view_count', 'author_id', 'status', 'created_at', 'updated_at'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'story_categories', 'story_id', 'category_id');
    }
    public function getCategoryAttribute()
    {
        if ($this->id) {
            $results = StoryCategory::where('story_id', $this->id)->get();

            if ($results) {
                $tmpCat = [];
                foreach ($results as $key => $item) {
                    $tmpCat[] = $item->category_id;
                }
                return $tmpCat;
            }
        }
        return [];
    }
    public function scopeGetBySlug($query, $slug) {
        $query->where('slug', $slug);
        return $query;
    }
}
