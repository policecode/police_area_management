<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use Carbon\Carbon;

class OrderChapter extends Model
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
        'user_id', 'story_id', 'chapter_id', 'money'
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        // Chuyển về múi giờ +7 trước khi format
        return Carbon::instance($date)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    }
    // protected $casts = [
    //     'created_at' => 'datetime:d/m/Y H:i:s',
    // ];
    private $joinUserStoryChapter = false;

    public function scopeGetByUser($query, $user_id) {
        if ($user_id) {
            return $query->where('order_chapters.user_id', $user_id);
        }
    }

    public function scopeGetByStory($query, $story_id) {
        if ($story_id) {
            return $query->where('order_chapters.story_id', $story_id);
        }
    }

    public function scopeGetByChapter($query, $chapter_id) {
        if ($chapter_id) {
            return $query->where('order_chapters.chapter_id', $chapter_id);
        }
    }

    public function scopeJoinUserStoryChapter($query) {
        if ($this->joinUserStoryChapter ) {
            return $query;
        }
        $query->select('order_chapters.*', 'U.name AS user_name', 'U.email AS user_email', 'S.title AS story_title', 'S.slug AS story_slug', 'C.name AS chapter_title', 'C.position AS chapter_position')
        ->leftJoin('users as U', function($join) {
            $join->on('order_chapters.user_id', '=', 'U.id');
        })
        ->leftJoin('stories as S', function($join) {
            $join->on('order_chapters.story_id', '=', 'S.id');
        })
        ->leftJoin('chapers as C', function($join) {
            $join->on('order_chapters.chapter_id', '=', 'C.id');
        });
        $this->joinUserStoryChapter = true;
    
        return $query;
    }
}
