<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::macro('getOrPaginate', function (int $maxResults = 500, int $defaultSize = 25) {
            $query = $this;
            if (request()->has('full')) {
                return $query->get();
            } else {
                $size = (int) request()->input('page_size', $defaultSize);
                $size = $size > $maxResults || $size < 1 ? $maxResults : $size;

                return $query->paginate($size);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user) {
            return $user->hasRole(['Owner', 'Bot']) ? true : null;
        });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });

        Http::macro('discord', function (?string $token = null) {
            $bearerToken = $token ?? auth()->user()->discord_token ?? '';

            return Http::withHeaders([
                'Authorization' => 'Bearer '.$bearerToken,
            ])->baseUrl(config('services.discord.api_url'));
        });

        Http::macro('discordBot', function () {
            return Http::withHeaders([
                'Authorization' => 'Bot '.config('services.discord.bot_token'),
            ])->baseUrl(config('services.discord.api_url'));
        });
    }
}
