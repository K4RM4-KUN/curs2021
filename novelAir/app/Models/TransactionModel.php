<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'token',
        'email',
        'amount',
        'state'
    ];

    protected $table = "transactions";
}