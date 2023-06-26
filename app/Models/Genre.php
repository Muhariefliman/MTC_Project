<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genreID',
        'name'
    ];

    // Create relationship one to many with Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
