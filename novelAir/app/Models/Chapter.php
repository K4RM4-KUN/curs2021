<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Novel;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = ['title','public','chapter_n','views'];

    public function novels()
    {
        return $this->belongsTo(Novel::class);
    }

    protected $table = "chapters";
}
