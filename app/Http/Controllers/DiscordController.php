<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function redirect(Request $request)
    {
        return Socialite::driver('discord')->redirect();
    }
    public function callback(Request $request): JsonResponse
    {
        $user = Socialite::driver('discord')->user();
        dd($user);

        // $user = User::updateOrCreate([
        //     'email' => $user->email,
        // ], [
        //     'name' => $user->name,
        // ]);
        // if ($user->wasRecentlyCreated) {
        //     $user->email_verified_at = now();
        //     /**
        //      * @var Team
        //      */
        //     $team = Team::find(config('services.authentik.registration_team_id'));
        //     $user->teams()->attach($team, [
        //         'role' => Team::ROLE['member'],
        //     ]);
        //     $user->current_team_id = $team->id;
        //     $user->save();
        // }

        // Auth::guard('web')->login($user);

        // $request->session()->regenerate();

        return response()->json([$user], 204);
    }
}
