<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['amount','donator_id','user_id','message'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = "donations";
} 
