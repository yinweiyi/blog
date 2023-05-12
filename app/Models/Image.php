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
        'image_url', 'width', 'height', 'likes', 'hearts', 'dislikes', 'prompt', 'negative_prompt', 'media_id', 'order', 'image_model_id',
    ];
}
