<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketTranscript\StoreRequest;
use App\Http\Resources\TicketTranscriptResource;
use App\Models\TicketTranscript;

class TicketTranscriptController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): TicketTranscriptResource
    {
        TicketTranscript::upsert([
            $request->validated(),
        ], uniqueBy: ['message_id'], update: ['ticket_id', 'discord_user_id', 'message', 'attachments', 'embeds']);

        return new TicketTranscriptResource(TicketTranscript::where('message_id', $request->validated('message_id'))->first());
    }
}
