<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoiesCourse extends Model
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
        'category_id', 'course_id'
    ];
    public function scopeGetByCourseId($query, $course_id){
        return $query->where('course_id', $course_id);
    }

 
}
