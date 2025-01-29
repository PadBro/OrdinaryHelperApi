<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketPanel extends Model
{
    /** @use HasFactory<\Database\Factories\TicketPanelFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    /**
     * @return HasMany<TicketButton, $this>
     */
    public function ticketButtons(): HasMany
    {
        return $this->hasMany(TicketButton::class);
    }
}
