<?php

namespace App\Models;

use App\Models\Traits\HasDateTimeFormatter;
use Database\Factories\AdministratorFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Administrator extends Authenticatable
{
    use HasFactory, HasApiTokens, HasDateTimeFormatter;

    protected $fillable = [
        'name', 'account', 'password', 'status', 'last_login_ip', 'last_login_at'
    ];

    protected $hidden = ['password'];

    protected $casts = ['status' => 'boolean'];

    /**
     * Create a new factory instance for the model.
     *
     * @return AdministratorFactory|Factory
     */
    protected static function newFactory(): AdministratorFactory|Factory
    {
        return new AdministratorFactory();
    }

    /**
     * password cast
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }
}
