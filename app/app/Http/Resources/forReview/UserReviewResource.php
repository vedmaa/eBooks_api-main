<?php

namespace App\Http\Resources\forReview;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $surname
 * @property mixed $patronymic
 * @property mixed $name
 * @property mixed $email
 * @property mixed $username
 */
class UserReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'username'=> $this->username,
        ];
    }
}
