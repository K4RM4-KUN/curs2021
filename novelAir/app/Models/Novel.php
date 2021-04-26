<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = ['name','genre','sinopsis'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    protected $table = "novels";
}
