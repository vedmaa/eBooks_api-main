<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'bookshelves', 'shelf_id', 'book_id');
    }
}

