<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Chaper extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = ['name', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['story_id', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug', 'story_id', 'content', 'position', 'view',
    ];
    private $joinStory = false;
    public function scopeGetByPosition($query, $position) {
        $query->where('position', $position);
        return $query;
    }
    public function scopeGetByStory($query, $story_id) {
        $query->where('story_id', $story_id);
        return $query;
    }
    public function scopeGetById($query, $id) {
        $query->where('id', $id);
        return $query;
    }
    public function scopeGetBySlug($query, $slug) {
        $query->where('slug', $slug);
        return $query;
    }
    public function scopeJoinStory($query) {
        if ($this->joinStory ) {
            return $query;
        }
        $query->select('chapers.id', 'chapers.name', 'chapers.slug', 'chapers.view', 'chapers.position', 'chapers.created_at', 'chapers.updated_at', 'stories.slug AS story_slug')
        ->leftJoin('stories', function($join) {
            $join->on('chapers.story_id', '=', 'stories.id');
        });
        $this->joinStory = true;
        return $query;
    }

    public function scopeSelectNotContent($query) {
        $query->select('id', 'name', 'slug', 'view', 'position', 'created_at', 'updated_at');
        return $query;
    }
}
