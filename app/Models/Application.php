<?php

namespace App\Models;

use App\Enums\ApplicationState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    protected $casts = [
        'state' => ApplicationState::class,
    ];
}
