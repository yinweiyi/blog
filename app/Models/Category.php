<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasDateTimeFormatter;
    protected $fillable = [
        'parent_id', 'name', 'slug', 'order', 'description'
    ];
}
