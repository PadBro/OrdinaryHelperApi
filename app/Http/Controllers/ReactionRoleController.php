<?php

namespace App\Http\Controllers;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\ReactionRole;
use App\Http\Requests\StoreReactionRoleRequest;
use App\Http\Requests\UpdateReactionRoleRequest;
use App\Rules\DiscordMessageRule;

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
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReactionRoleRequest $request)
    {
        list(, $channelId, $messageId) = DiscordMessageRule::splitMessageLink($request->validated('message_link'));
        return ReactionRole::create([
            ...$request->validated(),
            "message_id" => $channelId,
            "channel_id" => $messageId,
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
            "message_id" => $channelId,
            "channel_id" => $messageId,
        ]);
        return $reactionRole->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReactionRole $reactionRole)
    {
        return $reactionRole->delete();
    }
}
