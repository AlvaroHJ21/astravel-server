<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json([
                "message" => "Bad request",
                "error" => "Invalid credentials"
            ], 400);
        }

        $user = User::where("email", $request->email)->firstOrFail();

        $token = $user->createToken("auth_token")->plainTextToken;

        $ok = true;
        $data = $user;
        return response()->json(compact("ok", "data", "token"));
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            "ok" => true,
            "message" => "Logged out successfully"
        ]);
    }
}
