<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Filterable;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Filterable;
    protected $appends = ['group'];
    public $filterKeywords = ['email', 'name']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['email', 'name']; // SỬ dụng khi tìm kiếm dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group_id', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getGroupAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->group_id) {
            return Group::find($this->group_id);
        }
        return [];
    }
}
