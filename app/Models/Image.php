<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, HasDateTimeFormatter, SoftDeletes;

    protected $fillable = [
        'image_url', 'width', 'height', 'likes', 'hearts', 'dislikes', 'prompt', 'negative_prompt', 'cfg_scale', 'steps', 'sampler', 'seed', 'clip_skip', 'order', 'image_model_id',
    ];

    protected $casts = ['cfg_scale' => 'float'];

}
