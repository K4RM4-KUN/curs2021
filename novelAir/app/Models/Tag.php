<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag_Novel;

class Tag extends Model
{
    use HasFactory;

    public function tag_novel()
    {
        return $this->hasMany(Tag_Novel::class);
    }

    protected $table = "tags";
}
