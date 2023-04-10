<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Setting extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = ['key', 'value'];

    protected $casts = ['value' => 'array'];

    /**
     * 评论
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
