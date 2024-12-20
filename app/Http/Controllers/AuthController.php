<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        session()->regenerate();

        return response()->json([]);
    }

    public function logout(): JsonResponse
    {
        Auth::guard('web')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
