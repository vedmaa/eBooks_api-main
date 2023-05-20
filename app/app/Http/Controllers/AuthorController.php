<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::query();
        if ($fio = $request->input('search')) {
            $query->orWhere('surname', 'like', "%$fio%")
                ->orWhere('name', 'like', "%$fio%")
                ->orWhere('patronymic', 'like', "%$fio%");
        }
        return AuthorResource::collection($query->get());
    }

    public function store(AuthorRequest $request)
    {
        $created_author = Author::create($request->validated());
        return new AuthorResource($created_author);
    }


    public function show(Author $author)
    {
        return new AuthorResource($author);
    }


    public function update(AuthorRequest $request, Author $author)
    {
        $author->update(array_filter($request->validated()));
        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response()->noContent();
    }
}
