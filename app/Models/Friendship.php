<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $casts = ['status' => 'boolean'];

    protected $fillable = ['title', 'link', 'status', 'order', 'description'];
}
