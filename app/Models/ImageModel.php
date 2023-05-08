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
        'name', 'description', 'order', 'status'
    ];

    protected $casts = ['status' => 'boolean'];
}
