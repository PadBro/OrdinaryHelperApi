<?php

namespace App\Http\Resources;

use App\Repositories\DiscordRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketTeamRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<int, mixed>|\JsonSerializable
     */
    public function toArray(Request $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        $discordRepository = new DiscordRepository;

        /** @var \App\Models\TicketTeamRole $ticketTeamRole */
        $ticketTeamRole = $this->resource;

        $role = $discordRepository->roles()->first(fn ($role) => $role['id'] === $ticketTeamRole->role_id);

        return [
            ...$ticketTeamRole->toArray(),
            'role_name' => $role ? $role['name'] : 'role-not-found',
        ];
    }
}
