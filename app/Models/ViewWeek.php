<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class ViewWeek extends Model
{
    use HasFactory, Filterable;
    public $filterKeywords = ['story_id', ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['story_id', ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id', 'view', 'key'
    ];
}
