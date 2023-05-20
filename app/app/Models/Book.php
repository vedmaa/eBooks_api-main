<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $image
 * @property mixed $file
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year_of_issue',
        'image',
        'file',
        'rating',
        'price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'book_id', 'user_id');
    }

    public function shelves()
    {
        return $this->hasMany(Shelf::class,  'book_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'book_id', 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id');
    }
}
