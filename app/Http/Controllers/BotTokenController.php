<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class BotTokenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        if (! request()->user()?->hasRole('Owner')) {
            abort(403);
        }
        $user = User::firstOrCreate([
            'name' => 'Discord Bot',
            'nickname' => 'Discord Bot',
            'discord_id' => '0',
            'avatar' => '',
            'discord_token' => '',
            'discord_refresh_token' => '',
        ]);
        $user->syncRoles('Bot');

        $user->tokens()->delete();
        $token = $user->createToken('Discord Bot');

        return response()->json(['token' => $token->plainTextToken]);
    }
}
