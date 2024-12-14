<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->password = Hash::make($request->password);

        return tap($user)->save();
    }
}

