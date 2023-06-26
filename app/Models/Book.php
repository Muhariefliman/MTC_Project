<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookID',
        'genreID',
        'title',
        'cover',
        'synopsis',
        'author',
        'quantity',
        'price'
    ];

    // Create relationship one to one with Genre
    public function genre()
    {
        return $this->hasOne(Genre::class);
    }
}
