<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;


    protected $fillable = [
        'title', 'slug', 'author', 'content_type', 'markdown', 'html', 'description', 'keywords', 'is_top',
        'is_show', 'views', 'order', 'category_id'
    ];

    protected $casts = [
        'is_top' => 'boolean',
        'is_show' => 'boolean',
    ];

    /**
     * 关联标签
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 关联分类
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 评论
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * to html
     *
     * @return string
     */
    public function stripTagHtml(): string
    {
        $stripTagsHtml = strip_tags($this->attributes['html']);

        return Str::limit($stripTagsHtml, 415);
    }
}
