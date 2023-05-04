<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLike extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'ip', 'image_id', 'type'
    ];


}
