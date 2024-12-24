<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\User;

class BotTokenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = User::firstOrCreate([
            "name" => "Discord Bot",
            "nickname" => "Discord Bot",
            "discord_id" => "0",
            "avatar" => "",
            "discord_token" => "",
            "discord_refresh_token" => "",
        ]);
        $user->tokens()->delete();
        $token = $user->createToken("Discord Bot");

        return response()->json(['token' => $token->plainTextToken]);
    }
}
