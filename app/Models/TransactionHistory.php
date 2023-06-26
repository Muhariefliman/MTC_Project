<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionHistoryID',
        'transaction_header_ID',
        'total_price',
        'date'
    ];

    // Create relationship one to one with TransactionHeader
    public function transactionHeader()
    {
        return $this->hasOne(TransactionHeader::class);
    }
}
