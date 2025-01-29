<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketTeam extends Model
{
    /** @use HasFactory<\Database\Factories\TicketTeamFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    /**
     * @return HasMany<TicketButton, $this>
     */
    public function ticketButtons(): HasMany
    {
        return $this->hasMany(TicketButton::class);
    }

    /**
     * @return HasMany<TicketTeamRole, $this>
     */
    public function ticketTeamRoles(): HasMany
    {
        return $this->hasMany(TicketTeamRole::class);
    }
}
