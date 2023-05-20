<?php

namespace App\Http\Resources\forBook;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property mixed $books
 * @property string $information
 */
class AuthorBookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'information' => $this->information,
        ];
    }
}
