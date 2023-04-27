<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    protected $fillable = [
        'name', 'size', 'download_url', 'default_prompt', 'default_negative_prompt', 'description', 'order', 'status'
    ];

    protected $casts = ['status' => 'boolean', 'size' => 'float'];
}
