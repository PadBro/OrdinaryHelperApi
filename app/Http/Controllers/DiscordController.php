<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{
    public function redirect(Request $request)
    {
        return Socialite::driver('discord')->redirect();
    }
    public function callback(Request $request): JsonResponse
    {
        $user = Socialite::driver('discord')->stateless()->user();

        $response = Http::discord($user->token)->get('/users/@me/guilds/1216052687645184010/member');
        $json = $response->json();

        if (!$json || !$json['roles']) {
            abort(401, "not on server");
        }
        $roles = [
            '1216109838183043143', // owner
            '1216109903093956728', // moderator
            '1216109903022919790', // administrator
        ];
        $allowedUserRoles = array_intersect($json['roles'], $roles);
        if (count($allowedUserRoles) <= 0) {
            abort(401, "no roles");
        }

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
