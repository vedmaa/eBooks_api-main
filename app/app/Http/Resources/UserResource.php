<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $surname
 * @property mixed $name
 * @property mixed $patronymic
 * @property mixed $email
 * @property mixed $reviews
 * @property mixed $bookmarks
 * @property mixed $quotes
 * @property mixed $remember_token
 * @property mixed $username
 * @property mixed $shelves
 * @property mixed $id
 * @property mixed $wallet
 * @property mixed $role
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'username'=> $this->username,
            'role' => new RoleResource($this->role),
            'wallet' => $this->wallet,
            'reviews' => ReviewResource::collection($this->reviews),
            'bookmarks' => BookResource::collection($this->bookmarks),
            'shelves' => ShelfResource::collection($this->shelves),
            'quotes' => $this->quotes,
            'token' => $this->remember_token
        ];
    }
}
