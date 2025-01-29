<?php

namespace App\Http\Resources;

use App\Repositories\DiscordRepository;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<int, mixed>|\JsonSerializable
     */
    public function toArray(Request $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        $discordRepository = new DiscordRepository;
        $ticketRepository = new TicketRepository($discordRepository);

        /** @var \App\Models\Ticket $ticket */
        $ticket = $this->resource;

        return [
            ...$ticket->toArray(),
            'channel_name' => $ticketRepository->getChannelName($ticket),
            'ticket_button' => new TicketButtonResource($this->whenLoaded('ticketButton')),
            'ticket_transcripts' => TicketTranscriptResource::collection($this->whenLoaded('ticketTranscripts')),
            'created_by_discord_user' => $discordRepository->getUserById($ticket->created_by_discord_user_id),
            'closed_by_discord_user' => $ticket->closed_by_discord_user_id ?
                $discordRepository->getUserById($ticket->closed_by_discord_user_id) :
                null,
        ];
    }
}
