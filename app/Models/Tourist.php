<?php

namespace App\Models;

use App\Enums\Country;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Tourist extends Model
{
    use HasFactory, Filterable;
    public $filterKeywords = []; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = []; // SỬ dụng khi tìm kiếm dữ liệu cùng với tên trường trong DB;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug', 'birthday', 'gender', 'country', 'note', 'passport', 'album'
    ];

    protected $appends = ['gender_display', 'country_display'];
    /**
     * get typeDisplay
     */
    public function getGenderDisplayAttribute()
    {
        $enumsGenderArr = Gender::getValues();
        $result = '';
        foreach ($enumsGenderArr as $key => $enum) {
            if ($enum['key'] == $this->gender) {
                $result=$enum['value'];
                break;
            }
        }
        return $result;
    }
    public function getCountryDisplayAttribute()
    {
        return Country::fromKey($this->country);
    }
}
