<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Filterable;

    public $filterKeywords = [ ]; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = []; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permissions'
    ];
    protected $casts = [
        'permissions' => 'array',
    ];
    public $timestamps = false;

    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function getPermissionsAttribute($value)
    {
        return json_decode($this->attributes['permissions']);
    }
}
