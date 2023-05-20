<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeratorRequest;
use App\Http\Resources\ModeratorResource;
use App\Models\Moderator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModeratorController extends Controller
{
    public function index()
    {
        return ModeratorResource::collection(Moderator::all());
    }

    public function store(ModeratorRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request['password']);
        $created_moderator = Moderator::create($data);
        return new ModeratorResource($created_moderator);
    }

    public function show(Moderator $moderator)
    {
        return new ModeratorResource($moderator);
    }

    public function update(Request $request, Moderator $moderator)
    {
        //TODO
    }

    public function destroy(Moderator $moderator)
    {
        $moderator->delete();
        return response()->noContent();
    }
}
