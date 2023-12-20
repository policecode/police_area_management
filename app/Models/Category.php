<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = ['name']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['name', 'parent_id']; // SỬ dụng khi tìm kiếm dữ liệu cùng với tên trường trong DB

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function childrent() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategory() {
        return $this->childrent()->with('subCategory');
    }

    public function scopeGetByParentId($query, $parentId){
        return $query->where('parent_id', $parentId);
    }
}
