<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        if ($fio = $request->input('search')) {
            $query->orWhere('surname', 'like', "%$fio%")
                ->orWhere('name', 'like', "%$fio%")
                ->orWhere('patronymic', 'like', "%$fio%");
        }
        return UserResource::collection($query->get());
    }

    public function store(UserStoreRequest $request)
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

    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user) : UserResource
    {
        $data = array_filter($request->validated());
        $user->update($data);
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
