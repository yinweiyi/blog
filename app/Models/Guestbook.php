<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Guestbook extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'guestbook';

    protected $casts = ['is_top' => 'boolean'];

    /** 评论
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
