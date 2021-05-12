<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_Role;

class Role extends Model
{
    use HasFactory;

    public function userrole()
    {
        return $this->hasMany(User_Role::class);
    }

    protected $table = "roles";
}
