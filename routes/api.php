<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqsController;

Route::resource('faqs', FaqsController::class);
