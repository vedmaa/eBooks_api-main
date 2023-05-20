<?php

namespace App\Http\Resources\forReview;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $year_of_issue
 * @property mixed $id
 * @property mixed $title
 * @property mixed $image
 * @property mixed $authors
 * @property mixed $file
 * @property mixed $rating
 * @property mixed $reviews
 */
class BookReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'yearOfIssue' => $this->year_of_issue,
            'image' => $this->image != null ? asset(Storage::url($this->image)) : null,
            'file' => $this->file != null ? asset(Storage::url($this->file)) : null,
            'authors' => $this->authors,
            'rating' => round($this->rating, 2),
        ];
    }
}
