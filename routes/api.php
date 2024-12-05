<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DiscordController;

Route::resource('faqs', FaqController::class);
Route::resource('rules', RuleController::class);
Route::group(['middleware' => ['web']], function () {
    Route::get('discord/callback', [DiscordController::class, 'callback']);
    Route::get('discord/redirect', [DiscordController::class, 'redirect']);
});
