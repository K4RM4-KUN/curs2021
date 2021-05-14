<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Mark;
use App\Models\UNS;
use App\Models\States;
use Illuminate\Support\Facades\DB;
use App\Models\User_Role;
use App\Models\Role;

class AdminController extends Controller
{
    public function adminIndex(){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin'){

            return view('admin.main',$data);
        }else{
            return redirect("/dashboard");
        };
    }
}
