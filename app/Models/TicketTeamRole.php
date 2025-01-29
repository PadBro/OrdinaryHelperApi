<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketTeamRole extends Model
{
    /** @use HasFactory<\Database\Factories\TicketTeamRoleFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'udpated_at'];

    /**
     * @return BelongsTo<TicketTeam, $this>
     */
    public function ticketTeamRoles(): BelongsTo
    {
        return $this->belongsTo(TicketTeam::class);
    }
}
