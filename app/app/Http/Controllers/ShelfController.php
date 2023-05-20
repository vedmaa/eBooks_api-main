<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookshelfRequest;
use App\Http\Requests\ShelfRequest;
use App\Http\Resources\ShelfResource;
use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Shelf::query();
        if ($user_id = $request->input('user')) {
            $query->where('user_id', $user_id);
        }

        return ShelfResource::collection($query->get());
    }

    public function store(ShelfRequest $request)
    {
        $created_shelf = Shelf::create($request->validated());
        return new ShelfResource($created_shelf);
    }

    public function show(Shelf $shelf)
    {
        return new ShelfResource($shelf);
    }

    public function update(ShelfRequest $request, Shelf $shelf)
    {
        $shelf->update($request->validated());
        return new ShelfResource($shelf);
    }

    public function destroy(Shelf $shelf)
    {
        $shelf->delete();
        return response()->noContent();
    }
}
