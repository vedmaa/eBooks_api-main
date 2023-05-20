<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookshelfRequest;
use App\Http\Resources\ShelfResource;
use App\Models\Bookshelf;
use App\Models\Shelf;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class BookshelfController extends Controller
{

    public function index(Request $request)
    {
        $query = Bookshelf::query();
        if ($shelf = $request->input('shelf')) {
            $query->where('shelf_id', 'like', "%$shelf%");
        }

        if ($book = $request->input('book')) {
            $query->where('book_id', 'like', "%$book%");
        }
        $bookshelf = $query->get()->first();
        if ($bookshelf == null) {
            return [];
        }

        if ($is_delete = $request->input('delete')) {
            if($is_delete){
                $bookshelf->delete();
                return response(['message' => 'Успешное удаление']);
            }
        }
        //$filtered = Book::all()->whereIn('id', $bookmarks->pluck('book_id'));
        return $bookshelf;
    }

    public function store(BookshelfRequest $request)
    {
        $created_bookshelf = Bookshelf::create($request->validated());
        return new ShelfResource(Shelf::all()->where('id', '=', $created_bookshelf->shelf_id));
    }

    public function destroy(Bookshelf $bookshelf)
    {
        $bookshelf->delete();
        return response()->noContent();
    }
}
