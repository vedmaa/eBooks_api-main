<?php

namespace App\Http\Resources;

use App\Http\Resources\forReview\UserReviewResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user
 * @property mixed $books
 * @property mixed $title
 * @property mixed $id
 * @property mixed $user_id
 */
class ShelfResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'books' => BookResource::collection($this->books),
            'owner' => new UserReviewResource(User::all()->firstWhere('id', $this->user_id)),
        ];
    }
}
