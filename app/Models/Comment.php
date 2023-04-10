<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = [
        'parent_id',
        'content',
        'avatar',
        'nickname',
        'email',
        'commentable_id',
        'commentable_type',
        'ip',
        'is_read',
        'is_admin_reply',
        'is_audited',
        'top_id'
    ];

    // 返回空值即可禁用 order 字段
    public function getOrderColumn()
    {
        return null;
    }

    const Types = [
        'article'   => Article::class,
        'guestbook' => Setting::class,
    ];

    protected string $titleColumn = 'content';

    /**
     * 获取拥有此评论的模型
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function top(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'top_id');
    }
}
