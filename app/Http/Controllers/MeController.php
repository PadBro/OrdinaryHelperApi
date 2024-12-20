<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MeController extends Controller
{
    /**
     * Get the current user.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json();
        }
        $discordGuildUser = Cache::remember('user-'.$user->id, 120, function () {
            $response = Http::discord()->get('/users/@me/guilds/'.config('services.discord.server_id').'/member');

            return $response->json();
        });

        if (! $discordGuildUser || ! isset($discordGuildUser['roles'])) {
            Cache::forget('user-'.$user->id);
            Auth::guard('web')->logout();

            return response()->json();
        }

        if (! in_array(config('services.discord.required_role'), $discordGuildUser['roles'])) {
            Cache::forget('user-'.$user->id);
            Auth::guard('web')->logout();

            return response()->json();
        }

        return response()->json($user);
    }
}
