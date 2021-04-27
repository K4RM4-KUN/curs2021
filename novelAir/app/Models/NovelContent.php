<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovelContent extends Model
{
    use HasFactory;
    protected $fillable = ['name','chapter_id'];

    protected $table = "novel_content";
}
