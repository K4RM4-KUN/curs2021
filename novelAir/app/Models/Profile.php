<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['private',
    'imgtype',
    'presentation',
    'state_id',
    'twitter',
    'showTwitter',
    'facebook',
    'showFace',
    'instagram',
    'showInstagram',
    'patreon',
    'showPatreon',
    'other',
    'authorsRecomended',
    'idAuthorsRecomended',
    'showOther'];

    protected $table = "profile";
}
