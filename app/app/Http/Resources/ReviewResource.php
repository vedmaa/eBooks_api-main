<?php

namespace App\Http\Resources;

use App\Http\Resources\forReview\BookReviewResource;
use App\Http\Resources\forReview\UserReviewResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $rating
 * @property mixed $id
 * @property mixed $description
 * @property mixed $user_id
 * @property mixed $user
 * @property mixed $created_at
 * @property mixed $book_id
 */
class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'author' => new UserReviewResource(User::all()->firstWhere('id', $this->user_id)),
            'book' => new BookReviewResource(Book::all()->firstWhere('id', $this->book_id)),
            'rating' => $this->rating,
            'dateCreated' => $this->created_at,
        ];
    }
}
