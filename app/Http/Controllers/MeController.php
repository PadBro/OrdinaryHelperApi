<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Get the current user.
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
