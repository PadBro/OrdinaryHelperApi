<?php

namespace App\Http\Resources;

use App\Repositories\DiscordRepository;
use App\Rules\DiscordMessageRule;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReactionRoleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $discordRepository = new DiscordRepository;

        /** @var \App\Models\ReactionRole $reactionRole */
        $reactionRole = $this->resource;

        $role = $discordRepository->roles()->first(fn ($role) => $role['id'] === $reactionRole->role_id);

        return [
            ...$reactionRole->toArray(),
            'role_name' => $role ? $role['name'] : 'role-not-found',
            'message_link' => DiscordMessageRule::$discordChannelLinkBase.config('services.discord.server_id').'/'.$reactionRole->channel_id.'/'.$reactionRole->message_id,
        ];
    }
}
