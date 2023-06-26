<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'genre_ID',
        'book_ID'
    ];
}
