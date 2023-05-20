<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\ModeratorResource;
use App\Http\Resources\QuoteResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\RoleResource;
use App\Models\Moderator;
use App\Models\Quote;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $created_role = Role::create($request->validated());
        return new RoleResource($created_role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update(array_filter($request->validated()));
        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->noContent();
    }
}
