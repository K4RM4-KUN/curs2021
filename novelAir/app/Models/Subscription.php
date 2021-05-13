<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Subscription extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','subscriber_id','subscription_price'];

    public function user()
    {
        return $this->belongsTo(User::class,'subscriber_id');
    }

    protected $table = "subscriptions";
}
