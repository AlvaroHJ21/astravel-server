<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordSendRequest;
use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    //
    public function sendEmail(PasswordSendRequest $request)
    {

        Mail::to($request->email)->send(new PasswordReset($request->email));

        return response()->json([
            'message' => 'Email sent successfully'
        ]);
    }

    public function reset(PasswordResetRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'message' => 'Password reset successfully'
        ]);
    }
}
