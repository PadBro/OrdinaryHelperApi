<?php

namespace App\Http\Resources;

use App\Repositories\DiscordRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketPanelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<int, mixed>|\JsonSerializable
     */
    public function toArray(Request $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        $discordRepository = new DiscordRepository;

        /** @var \App\Models\TicketPanel $ticketPanel */
        $ticketPanel = $this->resource;

        $channel = $discordRepository->textChannels()->first(fn ($textChannel) => $textChannel['id'] === $ticketPanel->channel_id);

        return [
            ...$ticketPanel->toArray(),
            'channel_name' => $channel ? $channel['name'] : 'channel-not-found',
        ];
    }
}
