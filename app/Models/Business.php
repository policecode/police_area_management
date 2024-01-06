<?php

namespace App\Models;

use App\Enums\Business as EnumsBusiness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
class Business extends Model
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
        'user_id', 'name', 'slug', 'address', 'type', 'emterprises_id', 'note', 'manager'
    ];

    protected $appends = ['type_display'];
    /**
     * get typeDisplay
     */
    public function getTypeDisplayAttribute()
    {
        $enumsBusinessArr = EnumsBusiness::getValues();
        $result = '';
        foreach ($enumsBusinessArr as $key => $enum) {
            if ($enum['key'] == $this->type) {
                $result=$enum['value'];
                break;
            }
        }
        return $result;
    }
}
