<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationQuestionFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];
}
