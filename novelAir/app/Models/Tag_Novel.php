<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_Novel extends Model
{
    use HasFactory;

    protected $fillable = ['novel_id','tag_id'];

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }

    protected $table = "tags_novels";
}
