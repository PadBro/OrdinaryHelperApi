<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerContentMessage\CreateRequest;
use App\Models\ServerContentMessage;

class ServerContentMessageController extends Controller
{
    public function index(): ?ServerContentMessage
    {
        if (! request()->user()?->can('serverContentMessage.read')) {
            abort(403);
        }

        return ServerContentMessage::where('server_id', config('services.discord.server_id'))->first();
    }

    public function store(CreateRequest $request): ServerContentMessage
    {
        ServerContentMessage::upsert([
            [
                ...$request->validated(),
                'server_id' => config('services.discord.server_id'),
            ],
        ], uniqueBy: ['server_id'], update: ['heading', 'not_recommended', 'recommended']);

        return ServerContentMessage::where('server_id', config('services.discord.server_id'))->firstOrFail();
    }
}
