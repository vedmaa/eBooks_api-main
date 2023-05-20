<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["message" => "Не правильный URL"], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return ['message' => 'Email has been successfully confirmed'];
        }

        return ['message' => 'Email has already been confirmed'];
    }

    public function resendNotification() {
        if (auth()->user()->hasVerifiedEmail())
        {
            return response()->json(["message" => "Email уже подтвержден."], 400);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json(["message" => "Письмо с подтверждением отправлено на почту"]);
    }
}
