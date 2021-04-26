<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Novel;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = ['title','public','chapter_n'];

    public function chapters()
    {
        return $this->hasMany(Novel::class);
    }

    protected $table = "chapters";
}
