<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ReactionRoleController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'faqs' => FaqController::class,
        'rules' => RuleController::class,
        'reaction-roles' => ReactionRoleController::class,
    ]);
});
Route::post('discord/callback', [DiscordController::class, 'callback']);
Route::get('me', MeController::class);
