<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\MeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('faqs', FaqController::class);
    Route::resource('rules', RuleController::class);
});
Route::post('discord/callback', [DiscordController::class, 'callback']);
Route::get('me', MeController::class);
