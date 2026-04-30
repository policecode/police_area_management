<?php

namespace App\Models;

use App\Enums\FavoriteStatus;
use App\Enums\LockStories;
use App\Enums\StatusStory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use Illuminate\Support\Facades\Auth;

class Story extends Model
{
    use HasFactory, Filterable;
    protected $appends = ['status_name', 'is_convert', 'lock_status_name', 'url', 'dev_url'];
    public $filterKeywords = ['title', 'title_eng']; // Sử dụng trong trường hợp có trường keyword
    public $filterFields  = ['title', 'status', 'is_lock', 'propose']; // SỬ dụng khi tìm kiếm (==) dữ liệu cùng với tên trường trong DB
    public $filterTextFields = []; //Ử dụng khi tìm kiếm (LIKE) dữ liệu cùng với tên trường trong DB, ưu tiên trước filterFields
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'title_eng', 'slug', 'thumbnail', 'description', 'star_count', 'star_average', 'view_count', 'author_id', 'status', 'created_at', 'updated_at', 'last_chapers', 'chaper_id', 'total_chapter', 'total_favorite', 'total_percentage', 'total_report', 'last_comment_id', 'total_like', 'total_comment', 'is_lock', 'propose', 'buy_money', 'buy_position', 'total_money'
    ];

    private $joinAuthor = false;
    private $joinCategories = false;
    private $joinLastChapers = false;
    private $joinAuthorAndChapter = false;
    private $joinLastComment = false;

    public function categories() {
        return $this->belongsToMany(Category::class, 'story_categories', 'story_id', 'category_id');
    }
    public function getStatusNameAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->status) {
            foreach (StatusStory::asArray() as $key => $item) {
                if ($item['key'] == $this->status) {
                    return $item['value'];
                }
            }
        }
        return '';
    }
    public function getIsConvertAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ( strpos($this->title, '(c)')) {
            return true;
        }
        return false;
    }
    public function getLockStatusNameAttribute()
    {
        // Không nên dùng attribute để query dữ liệu
        if ($this->is_lock) {
            foreach (LockStories::asArray() as $key => $item) {
                if ($item['key'] == $this->is_lock) {
                    return $item['value'];
                }
            }
        }
        return '';

    }

    public function getUrlAttribute()
    {
        return route('client.story', ['story_slug' => $this->slug]);
    }

    public function getDevUrlAttribute()
    {
        return route('client.dev_total_20_chapter', ['story_slug' => $this->slug]);
    }

    public function scopeNoById($query, $id) {
        $query->where('stories.id', '!=', $id);
        return $query;
    }
    public function scopeGetBySlug($query, $slug) {
        $query->where('stories.slug', $slug);
        return $query;
    }
    public function scopeGetByAuthor($query, $author_id) {
        $query->where('stories.author_id', $author_id);
        return $query;
    }
    public function scopeGetByUnLock($query, $is_lock) {
        $query->where('stories.is_lock', $is_lock);
        return $query;
    }
    public function scopeGetById($query, $id) {
        if (is_array($id)) {
            $query->whereIn('stories.id', $id);
        } else {
            $query->where('stories.id', $id);
        }
        return $query;
    }
    public function scopeJoinAuthorAndChapter($query) {
        if ($this->joinAuthorAndChapter ) {
            return $query;
        }
        $query->select('stories.*', 'authors.name AS author_name', 'authors.slug AS author_slug', 'chapers.name AS chaper_name', 'chapers.slug AS chaper_slug', 'chapers.position')
        ->leftJoin('authors', function($join) {
            $join->on('stories.author_id', '=', 'authors.id');
        })
        ->leftJoin('chapers', function($join) {
            $join->on('stories.chaper_id', '=', 'chapers.id');
        });
        $this->joinAuthorAndChapter = true;
        $this->joinLastChapers = true;
        $this->joinAuthor = true;
        return $query;
    }

    public function scopeJoinAuthor($query) {
        if ($this->joinAuthor ) {
            return $query;
        }
        $user = Auth::user();
        $like = FavoriteStatus::LIKE['id'];
        $query->select('stories.*', 'a1.name AS author_name', 'a1.slug AS author_slug', 's1.point_star AS is_ratings', 's2.id AS is_favorite')
        ->leftJoin('authors as a1', function($join) {
            $join->on('stories.author_id', '=', 'a1.id');
        });
        if ($user) {
            $query->leftJoin('star_ratings AS s1', function ($join) use($user) {
                $join->on('stories.id', '=', 's1.story_id')->where('s1.user_id', '=', $user->id);
            });

            $query->leftJoin('user_read_stories AS s2', function ($join) use($user, $like) {
                $join->on('stories.id', '=', 's2.story_id')->where('s2.user_id', '=', $user->id)->where('s2.favorite', '=', $like);
            });
        } else {
            $query->leftJoin('star_ratings AS s1', function ($join) use($user) {
                $join->on('stories.id', '=', 's1.story_id')->where('s1.user_id', '=', -1);
            });

            $query->leftJoin('user_read_stories AS s2', function ($join) use($like) {
                $join->on('stories.id', '=', 's2.story_id')->where('s2.user_id', '=', -1)->where('s2.favorite', '=', $like);
            });
        }
        $this->joinAuthor = true;
        return $query;
    }

    public function scopeJoinCategories($query) {
        if ($this->joinCategories ) {
            return $query;
        }
        $query->select('stories.*', 'story_categories.category_id')
        ->rightJoin('story_categories', function($join) {
            $join->on('stories.id', '=', 'story_categories.story_id');
        });
        $this->joinCategories = true;
        return $query;
    }

    public function scopeJoinChapers($query) {
        if ($this->joinLastChapers ) {
            return $query;
        }
        $query->select('stories.*', 'chapers.name AS chaper_name', 'chapers.slug AS chaper_slug', 'chapers.position')
        ->leftJoin('chapers', function($join) {
            $join->on('stories.chaper_id', '=', 'chapers.id');
        });
        $this->joinLastChapers = true;
        return $query;
    }

    public function scopeJoinLastComment($query) {
        if ($this->joinLastComment ) {
            return $query;
        }
        $query->select('stories.title', 'stories.slug', 'c.content', 'c.user_id', 'c.created_at', 'u.name')
        ->leftJoin('comments as c', function($join) {
            $join->on('stories.last_comment_id', '=', 'c.id');
        })
        ->leftJoin('users AS u', function($join) {
            $join->on('c.user_id', '=', 'u.id');
        });
        $this->joinLastComment = true;
        return $query;
    }

    public function scopeSearchByAuthor($query, $author_name) {
        $query->joinAuthor();
        $query->orWhere('authors.name', 'LIKE', '%' . $author_name . '%');
        return $query;
    }

    public function scopeGetByCategory($query, $cat_id) {
        $query->joinCategories();
        $query->where('story_categories.category_id', '=', $cat_id);
        return $query;
    }

    public function scopeGetLastComment($query) {
        $query->where('stories.last_comment_id', '>', 0);
        return $query;
    }

    public function scopeGetByPropose($query, $propose_status) {
        $query->where('stories.propose', '=', $propose_status);
        return $query;
    }

}
