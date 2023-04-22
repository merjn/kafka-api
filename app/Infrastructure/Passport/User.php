<?php

declare(strict_types=1);

namespace App\Infrastructure\Passport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'username',
    ];

    protected $hidden = [
        'password',
    ];
}
