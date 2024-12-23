<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use  App\Enums\CategoryType;
class Category extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['story_count', 'type_name'];
    public $filterKeywords = ['name', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['name', 'type']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'type'
    ];
    public $timestamps = false;
    
    public function stories() {
        return $this->belongsToMany(Story::class, 'story_categories', 'category_id', 'story_id');
    }
    public function scopeGetBySlug($query, $slug) {
        $query->where('slug', $slug);
        return $query;
    }

    public function getStoryCountAttribute()
    {
        if ($this->id) {
            $result = StoryCategory::select('id')->where('category_id', $this->id)->count();

            if ($result) {
                return $result;
            }
        }

        return 0;
    }

    public function getTypeNameAttribute()
    {
        if ($this->type) {
            $result = CategoryType::getCategoryTypeByKey($this->type);

            if ($result) {
                return $result['value'];
            }
        }

        return '';
    }
}
