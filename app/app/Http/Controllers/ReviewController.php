<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::query()->orderByDesc('created_at');
        if ($sort = $request->input('sort')) {
            $query->orderBy($sort);
        }
        if ($user_id = $request->input('user')) {
            $query->where('user_id', '=', $user_id);
        }
        if ($book_id = $request->input('book')) {
            $query->where('book_id', '=', $book_id);
        }
        return ReviewResource::collection($query->get());
    }

    public function store(ReviewRequest $request)
    {
        $created_review = Review::create($request->validated());
        $book_id = $request->book_id;
        $reviews = Review::all()->where('book_id', $book_id);
        $average = 0;
        if (count($reviews) > 0) {
            //Высчитываем среднее значение рейтинга
            $average = $reviews->sum('rating') / count($reviews);
        }
        //обновления рейтинга книги
        Book::all()->firstWhere('id', $book_id)->update(array('rating' => round($average, 2)));
        return new ReviewResource($created_review);
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function update(ReviewRequest $request, Review $review)
    {
        $review->update(array_filter($request->validated()));
        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->noContent();
    }
}
