<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookmarkController extends Controller
{

    public function index(Request $request)
    {
        $query = Bookmark::query();
        if ($user = $request->input('user')) {
            $query->orWhere('user_id', 'like', "%$user%");
        }
        $bookmarks = $query->get();
        if ($bookmarks->isEmpty()) {
            return [];
        }

        $filtered = Book::all()->whereIn('id', $bookmarks->pluck('book_id'));
        return BookResource::collection($filtered);
    }

    public function store(BookmarkRequest $request)
    {
        $old_bookmark = Bookmark::where('user_id', $request->user_id)->where('book_id', $request->book_id)->first();
        if ($old_bookmark) {
            $old_bookmark->delete();
            $book = Book::all()->firstWhere('id', $request->book_id);
            return response()->noContent();
        }
        $created_bookmark = Bookmark::create($request->validated());
        return new BookResource(Book::all()->firstWhere('id', '=', $created_bookmark->book_id));
    }

    public function destroy(Bookmark $bookmark): Response
    {
        $bookmark->delete();
        return response()->noContent();
    }
}
