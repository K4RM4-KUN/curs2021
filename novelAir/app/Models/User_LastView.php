<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_LastView extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'novel_id',
        'chapter_n',
    ];

    protected $table = "users_last_view";
}
