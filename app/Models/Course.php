<?php

namespace App\Models;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Course extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = []; // SỬ dụng khi tìm kiếm dữ liệu cùng với tên trường trong DB

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'detail', 'teacher_id', 'thumbnail', 'price', 'sale_price', 'code', 'durations', 'is_document', 'supports', 'status'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'categoies_courses',  'course_id', 'category_id');
    }

}
