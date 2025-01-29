<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<int, mixed>|\JsonSerializable
     */
    public function toArray(Request $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        /** @var \App\Models\TicketTeam $ticketTeam */
        $ticketTeam = $this->resource;

        return [
            ...$ticketTeam->toArray(),
            'ticket_team_roles' => TicketTeamRoleResource::collection($this->whenLoaded('ticketTeamRoles')),
        ];
    }
}
