<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DiscordRepository
{
    /**
     * @return Collection<int, array<string>>
     */
    public function roles(): Collection
    {
        /**
         * @var array<array<string>>
         */
        $roles = Cache::remember('discord-'.config('services.discord.server_id').'-roles', 300, function () {
            $response = Http::discordBot()->get('/guilds/'.config('services.discord.server_id').'/roles');

            return $response->json();
        });

        return collect($roles);
    }

    /**
     * @return Collection<int, array<mixed>>
     */
    public function channels(): Collection
    {
        /**
         * @var array<array<mixed>>
         */
        $roles = Cache::remember('discord-'.config('services.discord.server_id').'-channels', 300, function () {
            $response = Http::discordBot()->get('/guilds/'.config('services.discord.server_id').'/channels');

            return $response->json();
        });

        return collect($roles);
    }

    /**
     * @return Collection<int, mixed>
     */
    public function textChannels(): Collection
    {
        $channels = $this->channels();
        $textChannels = $channels->filter(fn ($channel) => $channel['type'] === 0);

        return $textChannels;
    }

    /**
     * @return Collection<int, mixed>
     */
    public function guild(): Collection
    {
        /**
         * @var array<array<mixed>>
         */
        $guild = Cache::remember('guild-'.config('services.discord.server_id'), 600, function () {
            $response = Http::discordBot()->get('/guilds/'.config('services.discord.server_id'));

            return $response->json();
        });

        return collect($guild);
    }

    /**
     * @return Collection<int, mixed>
     */
    public function currentUser(): Collection
    {
        /**
         * @var array<array<mixed>>
         */
        $currentUser = Cache::remember('user-'.auth()->user()?->id, 120, function () {
            $response = Http::discord()->get('/users/@me/guilds/'.config('services.discord.server_id').'/member');

            return $response->json();
        });

        return collect($currentUser);
    }
}
