<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $login
 */
class ModeratorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'login' => $this->login,
        ];
    }
}
