<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionID',
        'user_ID',
        'total_price',
        'transaction_date'
    ];

    // Create relationship one to many with TransactionDetail
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Create relationship one to one with User
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
