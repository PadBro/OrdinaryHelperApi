<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'discord_token',
        'discord_refresh_token',
    ];
}
