<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasDateTimeFormatter;

    protected $primaryKey = 'key';

    protected $fillable = ['key', 'value'];

    protected $casts = ['value' => 'array'];
}
