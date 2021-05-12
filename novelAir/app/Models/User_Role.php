<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class User_Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'rol_id',
        'user_id'
    ];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    protected $table = "user_roles";
}
