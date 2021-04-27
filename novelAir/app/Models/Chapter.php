<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Novel;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = ['title','public','chapter_n','views'];

    public function chapters()
    {
        return $this->hasMany(Novel::class);
    }
    public function novel_content()
    {
        return $this->hasMany(NovelContent::class);
    }

    protected $table = "chapters";
}
