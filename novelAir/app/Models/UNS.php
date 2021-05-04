<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UNS extends Model
{
    use HasFactory;

    protected $fillable = ['novel_id','state_id','user_id'];

    public function states()
    {

        return $this->hasMany(States::class);
        
    }

    protected $table = "uns";
}
