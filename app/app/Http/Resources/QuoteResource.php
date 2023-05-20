<?php

namespace App\Http\Resources;

use App\Http\Resources\forReview\UserReviewResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $text
 * @property mixed $book_id
 * @property mixed $user_id
 */
class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'text' => $this->text,
            'book' => new BookResource(Book::all()->firstWhere('id', $this->book_id)),
            'user' => new UserReviewResource(User::all()->firstWhere('id', $this->user_id)),
        ];
    }
}
