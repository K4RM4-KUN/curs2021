<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;
use App\Models\UNS;
use App\Models\Tag_Novel;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = ['name','genre','sinopsis','adult_content','visual_content','novel_type','public','imgtype'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function uns()
    {
        return $this->hasMany(UNS::class);
    }
    public function tag_novel()
    {
        return $this->hasMany(Tag_Novel::class);
    }

    protected $table = "novels";
}
