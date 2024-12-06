<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class DiscordController extends Controller
{
    public function redirect(Request $request)
    {
        return Socialite::driver('discord')->redirect();
    }
    public function callback(Request $request): JsonResponse
    {
        $user = Socialite::driver('discord')->stateless()->user();

        $user = User::updateOrCreate([
            'discord_id' => $user->id,
        ], [
            'name' => $user->name,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'discord_token' => $user->token,
            'discord_refresh_token' => $user->refreshToken,
        ]);

        Auth::guard('web')->login($user);

        $request->session()->regenerate();

        return response()->json([], 204);
    }
}
