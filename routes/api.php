<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotTokenController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ReactionRoleController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'faq' => FaqController::class,
        'rule' => RuleController::class,
        'reaction-role' => ReactionRoleController::class,
    ]);

    Route::apiResource('user', UserController::class)->only(['update']);

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('botToken', BotTokenController::class)->name('bot.token');
});
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('discord/callback', [DiscordController::class, 'callback']);
Route::get('me', MeController::class);
