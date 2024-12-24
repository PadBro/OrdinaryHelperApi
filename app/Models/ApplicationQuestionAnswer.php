<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationQuestionAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationQuestionAnswerFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];
}
