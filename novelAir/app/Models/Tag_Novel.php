<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_Novel extends Model
{
    use HasFactory;

    protected $fillable = ['novel_id','tag_id'];

    protected $table = "tags_novels";
}
