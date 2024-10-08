<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Author extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['story_count'];
    public $filterKeywords = ['name', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['name', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description'
    ];
    public $timestamps = false;
    public function scopeGetBySlug($query, $slug) {
        $query->where('slug', $slug);
        return $query;
    }

    public function getStoryCountAttribute()
    {
        if ($this->id) {
            $result = Story::select('id')->where('author_id', $this->id)->count();

            if ($result) {
                return $result;
            }
        }

        return 0;
    }
}
