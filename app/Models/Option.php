<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Option extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = [ ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = [ ]; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_key', 'option_value', 'autoload'
    ];

    public $timestamps = false;

    public function scopeGetByOptionKey($query, $option_key) {
        if (is_array($option_key)) {
            # $option_key = [key1, key2...]
            $query->whereIn('option_key', $option_key);
        } else {
            $query->where('option_key', $option_key);
        }
        return $query;
    }
    public function scopeGetByAutoLoad($query, $autoload_value) {
        $query->where('autoload', $autoload_value);
        return $query;
    }
}
