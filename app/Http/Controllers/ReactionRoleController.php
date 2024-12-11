<?php

namespace App\Http\Controllers;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\ReactionRole;
use App\Http\Requests\StoreReactionRoleRequest;
use App\Http\Requests\UpdateReactionRoleRequest;
use App\Rules\DiscordMessageRule;
use Illuminate\Support\Facades\Http;

class ReactionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QueryBuilder::for(ReactionRole::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('emoji'),
                AllowedFilter::exact('message_id'),
                AllowedFilter::exact('channel_id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReactionRoleRequest $request)
    {
        list(, $channelId, $messageId) = DiscordMessageRule::splitMessageLink($request->validated('message_link'));
        $urlEmoji = str_replace("<", "", $request->validated("emoji"));
        $urlEmoji = str_replace(">", "", $urlEmoji);
        $urlEmoji = urlencode($urlEmoji);
        $response = Http::discordBot()->put("/channels/".$channelId."/messages/".$messageId."/reactions/".$urlEmoji."/@me");
        if (!$response->successful()) {
            response([
                "errors" => [
                    "reaction" => ["Failed to create reaction."]
                ]
            ], 400);
        }


        return ReactionRole::create([
            ...$request->validated(),
            "message_id" => $messageId,
            "channel_id" => $channelId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReactionRoleRequest $request, ReactionRole $reactionRole)
    {
        list(, $channelId, $messageId) = DiscordMessageRule::splitMessageLink($request->validated('message_link'));
        $reactionRole->update([
            ...$request->validated(),
            "message_id" => $messageId,
            "channel_id" => $channelId,
        ]);
        return $reactionRole->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReactionRole $reactionRole)
    {
        $urlEmoji = str_replace("<", "", $reactionRole->emoji);
        $urlEmoji = str_replace(">", "", $urlEmoji);
        $urlEmoji = urlencode($urlEmoji);
        Http::discordBot()->delete("/channels/".$reactionRole->channel_id."/messages/".$reactionRole->message_id."/reactions/".$urlEmoji."/@me");
        return $reactionRole->delete();
    }
}
