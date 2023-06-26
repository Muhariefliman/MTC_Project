<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_header_id',
        'book_id',
        'quantity'
    ];

    // Create relationship one to one with TransactionHeader
    public function transactionHeader()
    {
        return $this->hasOne(TransactionHeader::class);
    }
}
