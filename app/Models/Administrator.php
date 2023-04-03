<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Database\Factories\AdministratorFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Administrator extends Authenticatable
{
    use HasFactory, HasApiTokens, HasDateTimeFormatter;

    protected $fillable = [
        'name', 'account', 'password', 'last_login_ip', 'last_login_at'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return AdministratorFactory|Factory
     */
    protected static function newFactory(): AdministratorFactory|Factory
    {
        return new AdministratorFactory();
    }
}
