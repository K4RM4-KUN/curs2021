<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Verification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','num_id','request_state'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = "verifications";
}
