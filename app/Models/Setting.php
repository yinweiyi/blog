<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Hash;

class Setting extends Model
{
    use HasDateTimeFormatter;

    protected $fillable = ['key', 'value'];

    protected $casts = ['value' => 'array'];

    const TITLES = [
        'guestbook' => '留言',
        'site'      => '站点配置'
    ];

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
     * 获取器
     *
     * @return Attribute
     */
    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => self::TITLES[$attributes['key']] ?? '-',
        );
    }


}
