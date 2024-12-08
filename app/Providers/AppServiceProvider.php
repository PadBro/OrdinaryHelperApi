<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::macro('getOrPaginate', function (int $maxResults = 500, int $defaultSize = 50) {
            /**
             * @var Builder<Model>
             */
            $query = $this;
            if (request()->has('paginate')) {
                $size = (int) request()->input('page_size', $defaultSize);
                $size = $size > $maxResults || $size < 1 ? $maxResults : $size;
                return $query->paginate($size);
            } else {
                return $query->get();
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });

        Http::macro('discord', function (?string $token) {
            return Http::withHeaders([
                'Authorization' => 'Bearer '. $token ?? auth()->user()?->discord_token ?? '',
            ])->baseUrl('https://discord.com/api');
        });
    }
}
