<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        $ok = true;
        $data = $user;
        $message = 'User created successfully';
        return response()->json(compact("ok", "message", "data",  "token"), 201);
    }
}
