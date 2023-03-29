<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
}
