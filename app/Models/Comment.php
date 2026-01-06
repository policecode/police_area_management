<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory, Filterable;
    protected $table = 'comments';
    protected $appends = ['view_name'];
    public $filterKeywords = ['content']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['user_id', 'story_id', 'parent_id', 'is_views']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields

    protected $fillable = [
        'user_id',
        'story_id',
        'parent_id',
        'content',
        'ask_user_id',
        'like',
        'is_views'
    ];

    private $joinUser = false;
    private $joinUserAndStory = false;
    private $joinStory = false;

    public function getViewNameAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->is_views) {
            $viewObj = CommentStatus::getByKey($this->is_views);
            return $viewObj['value'];
        }
        return '';
    }

    public function scopeGetByStory($query, $story_id)
    {
        if (is_array($story_id)) {
            $query->whereIn('comments.story_id', $story_id);
        } else {
            $query->where('comments.story_id', $story_id);
        }
        return $query;
    }
    public function scopeGetByUser($query, $user_id)
    {
        $query->where('comments.user_id', $user_id);
        return $query;
    }
    public function scopeGetByParent($query, $parent_id)
    {
        if (is_array($parent_id)) {
            $query->whereIn('comments.parent_id', $parent_id);
        } else {
            $query->where('comments.parent_id', $parent_id);
        }
        return $query;
    }
    public function scopeGetByView($query, $is_views)
    {
        $query->where('is_views', $is_views);
        return $query;
    }

    public function scopeGetById($query, $id)
    {
        if (is_array($id)) {
            $query->whereIn('id', $id);
        } else {
            $query->where('id', $id);
        }
        return $query;
    }

    public function scopeJoinUsers($query)
    {
        if ($this->joinUser) {
            return $query;
        }
        $user = Auth::user();
        $query->select('comments.*', 'u1.name', 'u1.avatar', 'u2.name AS ask_name', 'u2.avatar AS ask_avatar', 'c1.status')
            ->leftJoin('users AS u1', function ($join) {
                $join->on('comments.user_id', '=', 'u1.id');
            })
            ->leftJoin('users AS u2', function ($join) {
                $join->on('comments.ask_user_id', '=', 'u2.id');
            });
        if ($user) {
            $query->leftJoin('like_comments AS c1', function ($join) use($user) {
                $join->on('comments.id', '=', 'c1.comment_id')->where('c1.user_id', '=', $user->id);
            });
        } else {
            $query->leftJoin('like_comments AS c1', function ($join) use($user) {
                $join->on('comments.id', '=', 'c1.comment_id')->where('c1.user_id', '=', -1);
            });
        }

        $this->joinUser = true;
        return $query;
    }

    public function scopeJoinUsersAndStory($query)
    {
        if ($this->joinUserAndStory) {
            return $query;
        }
        $query->select('comments.*', 'users.name', 'users.avatar', 'stories.title', 'stories.slug')
            ->leftJoin('users', function ($join) {
                $join->on('comments.user_id', '=', 'users.id');
            })
            ->leftJoin('stories', function ($join) {
                $join->on('comments.story_id', '=', 'stories.id');
            });

        $this->joinUserAndStory = true;
        return $query;
    }

    public function scopeJoinStory($query)
    {
        if ($this->joinStory) {
            return $query;
        }
        $query->select('comments.*', 'stories.title', 'stories.slug')
            ->leftJoin('stories', function ($join) {
                $join->on('comments.story_id', '=', 'stories.id');
            });

        $this->joinStory = true;
        return $query;
    }

    public function scopeGetCommentChild($query, $listId)
    {
        $now = Carbon::now();
        $resutls = Comment::joinUsers()->whereIn('parent_id', $listId)->get()->each(function ($item, $key) use ($now) {
            $item->url_avatar = $item->avatar ? asset($item->avatar) : asset('assets/images/avatar_default.png');
            $item->url_profile = route('member.profile', ['user_id' => $item->user_id]);
            $item->url_ask_avatar = $item->ask_avatar ? asset($item->ask_avatar) : asset('assets/images/avatar_default.png');
            $item->url_ask_profile = route('member.profile', ['user_id' => $item->ask_user_id]);
            $item->after_minutes = $now->diffInMinutes(new Carbon($item->created_at));
        })->groupBy('parent_id')->toArray();
        return $resutls;
    }
}
