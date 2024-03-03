<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create($request->validated());

            $token = $user->createToken('auth_token')->plainTextToken;

            if (env("MAIL_ENABLED")) {
                Mail::to($user->email)->send(new EmailVerification($user->email));
            }

            DB::commit();

            $ok = true;
            $data = $user;
            $message = 'User created successfully';
            return response()->json(compact("ok", "message", "data",  "token"), 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            $ok = false;
            $message = 'Error creating user';
            return response()->json(compact("ok", "message"), 500);
        }
    }
}
