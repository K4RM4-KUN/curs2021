<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;
use App\Models\UNS;
use App\Models\User_LastView;

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
    public function user_lastviews()
    {
        return $this->hasMany(User_LastView::class);
    }

    protected $table = "novels";
}
