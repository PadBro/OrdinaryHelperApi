<?php

namespace App\Models;

use App\Enums\ApplicationResponseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationResponse extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationResponseFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    protected $casts = [
        'type' => ApplicationResponseType::class,
    ];
}
