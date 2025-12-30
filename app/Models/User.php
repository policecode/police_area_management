<?php

namespace App\Models;

use App\Enums\Level;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Filterable;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Filterable;
    protected $appends = ['group', 'avatar_url', 'banner_url', 'level_info'];
    public $filterKeywords = ['email', 'name']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['email', 'name']; // SỬ dụng khi tìm kiếm dữ liệu cùng với tên trường trong DB
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group_id', 'email_verified_at', 'remember_token', 'avatar', 'socialite', 'socialite_id', 'exp', 'level', 'money', 'total_story', 'total_chapter'
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

    public function getAvatarUrlAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
            return $this->avatar ? asset($this->avatar) : asset('assets/images/avatar_default.png');
    }
    public function getBannerUrlAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
            return $this->banner ? asset($this->banner) : asset('assets/images/banner_default.png');
    }

    public function getLevelInfoAttribute()
    {
        $level = Level::getLevel($this->level);
        return $level ? $level : Level::LEVEL1;
    }

    public function scopeGetByEmail($query, $email) {
        $query->where('users.email', $email);
        return $query;
    }

    public function scopeGetByRememberToken($query, $remember_token) {
        $query->where('users.remember_token', $remember_token);
        return $query;
    }

    public function scopeGetByEmailVerifiedAt($query, $email_verified_at) {
        $query->where('users.email_verified_at', $email_verified_at);
        return $query;
    }
}
