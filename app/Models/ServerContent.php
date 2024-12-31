<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feed
 *
 * @property string $heading
 * @property string $not_recommended
 * @property string $recommended
 */
class ServerContent extends Model
{
    /** @use HasFactory<\Database\Factories\ServerContentFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    protected $casts = [
        'is_recommended' => 'boolean',
    ];

    /**
     * @param  Builder<ServerContent>  $query
     */
    public function scopeNotRecommended(Builder $query): void
    {
        $query->where('is_recommended', false);
    }

    /**
     * @param  Builder<ServerContent>  $query
     */
    public function scopeRecommended(Builder $query): void
    {
        $query->where('is_recommended', true);
    }
}
