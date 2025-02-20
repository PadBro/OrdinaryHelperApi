<?php

namespace App\Http\Resources;

use App\Repositories\DiscordRepository;
use App\Repositories\TicketTranscriptRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketTranscriptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable<int, mixed>|\JsonSerializable
     */
    public function toArray(Request $request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        /** @var \App\Models\TicketTranscript $ticketTranscript */
        $ticketTranscript = $this->resource;

        $ticketTranscriptRepository = new TicketTranscriptRepository(new DiscordRepository);

        return [
            ...$ticketTranscript->toArray(),
            'user' => $ticketTranscriptRepository->getUser($ticketTranscript),
        ];
    }
}
