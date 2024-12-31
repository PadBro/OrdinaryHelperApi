<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerContent\StoreRequest;
use App\Http\Requests\ServerContent\UpdateRequest;
use App\Models\ServerContent;
use App\Models\ServerContentMessage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServerContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection<int, ServerContent>|LengthAwarePaginator<ServerContent>
     */
    public function index(): Collection|LengthAwarePaginator
    {
        return QueryBuilder::for(ServerContent::class)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('is_recommended'),
                AllowedFilter::exact('id'),
            ])
            ->getOrPaginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): ServerContent
    {
        return ServerContent::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ServerContent $serverContent): ServerContent
    {
        $serverContent->update($request->validated());

        return $serverContent->refresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServerContent $serverContent): bool
    {
        return $serverContent->delete() ?? false;
    }

    public function resend(): bool
    {
        /**
         * @var ServerContent $messages
         */
        $messages = ServerContentMessage::where('server_id', config('services.discord.server_id'))->first();
        $notRecommended = ServerContent::notRecommended()->get();
        $recommended = ServerContent::recommended()->get();

        $channelId = config('services.discord.server_content_channel');

        Http::discordBot()->post('/channels/'.$channelId.'/messages', [
            'content' => $messages->heading,
        ]);

        $notRecommendedMessages = $this->getMessages($messages->not_recommended, $notRecommended);
        foreach ($notRecommendedMessages as $notRecommendedMessage) {
            Http::discordBot()->post('/channels/'.$channelId.'/messages', [
                'content' => $notRecommendedMessage,
                'flags' => 4,
            ]);
        }

        $recommendedMessages = $this->getMessages($messages->recommended, $recommended);
        foreach ($recommendedMessages as $recommendedMessage) {
            Http::discordBot()->post('/channels/'.$channelId.'/messages', [
                'content' => $recommendedMessage,
                'flags' => 4,
            ]);
        }

        return true;
    }

    /**
     * @param  Collection<int, ServerContent>  $serverContents
     * @return array<string>
     */
    private function getMessages(string $message, Collection $serverContents): array
    {
        $mapFunction = function ($data) {
            return '- ['.$data['name'].']('.$data['url'].')\n  - '.$data['description'];
        };

        $messages = [
            $message,
            ...array_map($mapFunction, $serverContents->toArray()),
        ];
        $chunkedMessages = [''];
        $key = 0;
        foreach ($messages as $message) {
            if (strlen($chunkedMessages[$key]) + strlen($message) + 2 > 2000) {
                $key++;
                $chunkedMessages[$key] = '';
            }

            $chunkedMessages[$key] .= $message."\n";
        }

        return $chunkedMessages;
    }
}
