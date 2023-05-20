<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Mail\AuthCodeMail;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private int $code = 0;

    public function login1(Request $request)
    {
        $rules = array(
            'email' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $user = User::where('email', '=', $request->email)->first();
        if ($user == null)
            return response(
                ['message' => 'Неверный email'],
                401
            );


        if (Hash::check($request->password, $user->password)) {
            if (!$user->hasVerifiedEmail()) {
                return response(['message' => 'Не верифицирован'], 401);
            }
            $token = $user->createToken('token')->plainTextToken;

            $cookie = cookie('JWT', $token, 24 * 60 * 30); // 30 days
            $user->update(['remember_token' => $token]);

            $code = rand(100000, 999999);
            //$user->notify(new AuthCodeMail($code));
            //Mail::send(new AuthCodeMail($code));
            Mail::to($user)->send(new AuthCodeMail($code));

            $user = Auth::user();

//            return new UserResource($user);
            return response([
                'message' => 'Успешый вход',
                'token' => $token,
                'code' => $code
            ])->withCookie($cookie);
        } else return response([
            'message' => 'Неверный пароль'
        ], 401);
    }

    public function sendMessage(Request $request)
    {
        $rules = array(
            'email' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = User::where('email', '=', $request->email)->first();
        if ($user == null)
            return response(
                ['message' => 'Пользователя с таким email не существует'],
                401
            );
        if (!$user->hasVerifiedEmail()) {
            return response(['message' => 'Не верифицирован'], 401);
        }
        $this->code = rand(100000, 999999);
        Mail::to($user)->send(new AuthCodeMail($this->code));

        return response([
            'message' => "На почту $user->email отправлено сообщение с подтвеждением",
            'code' => Hash::make($this->code),
        ]);
    }

    public function login(Request $request)
    {

        $rules = array(
            'email' => 'required',
            'code' => 'required|integer',
            'hash' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        if (!Hash::check($request->code, $request->hash)) {
            return response(['message' => 'Неверный код', 401]);
        }
        $user = User::all()->firstWhere('email', $request->email);
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('JWT', $token, 24 * 60 * 30); // 30 days
        $user->update(['remember_token' => $token]);
        Auth::user();


        return new UserResource($user);
        //return new UserResource($user);
    }

    public function loginByToken(Request $request)
    {
        $token = $request->token;
        if ($token == null) {
            return response(['message' => 'Токена нет'], 401);
        }
        $user = User::all()->firstWhere('remember_token', $token);
        if ($user == null) {
            return response(['message' => 'Токен не действительный'], 401);
        }
        return new UserResource($user);
    }


    public function register(UserStoreRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($request['password']);
        $created_user = User::create($data);
        $created_user->sendEmailVerificationNotification();
        return [
            'message' => 'Пользователь успешно зарегистрирован',
            'verification' => "На почту $created_user->email отправлено сообщение с подтвеждением"
        ];
    }

    public function logout(Request $request)
    {

        $cookie = Cookie::forget('JWT');

        return response([
            'message' => 'успешно'
        ])->withCookie($cookie);
    }
}
