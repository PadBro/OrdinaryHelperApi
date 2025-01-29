<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    /**
     * @return BelongsTo<TicketButton, $this>
     */
    public function ticketButton(): BelongsTo
    {
        return $this->belongsTo(TicketButton::class);
    }

    /**
     * @return HasMany<TicketTranscript, $this>
     */
    public function ticketTranscripts(): HasMany
    {
        return $this->hasMany(TicketTranscript::class);
    }
}
