<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['novel_id','user_id','like'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function uns()
    {
        return $this->hasMany(UNS::class);
    }

    protected $table = "novels";
}
