<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verify(Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                "message" => "Invalid/Expired url provided"
            ], 401);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                "message" => "Email already verified"
            ], 422);
        }

        $request->user()->markEmailAsVerified();

        return response()->json([
            "message" => "Email verified",
            "user" => $request->user()
        ], 200);
    }
}
