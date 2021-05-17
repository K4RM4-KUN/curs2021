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
use App\Models\User;

class AdminController extends Controller
{
    public function adminIndex(){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin'){
            $data['users'] = User::orderbydesc('created_at')->take(24)->get();
            $data["novels"] = Novel::orderbydesc('created_at')->take(24)->get();
            return view('admin.main',$data);
        }else{
            return redirect("/dashboard");
        };
    }

    public function adminUser($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){
            
            $data['user'] = User::where('id',$id)->first();
            $data["novels"] = Novel::where('user_id',$id)->get();

            return view('admin.user',$data);
        }else{
            return redirect("/dashboard");
        };
    }

    public function adminNovel($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){

            $data['users'] = User::all();
            $data["novel"] = Novel::where('id',$id)->first();

            return view('admin.novel',$data);
        }else{
            return redirect("/dashboard");
        };
    }

    public function adminSearch(Request $request){
        if($request->user != null || $request->user == 'null'){
            return redirect("admin/user/$request->user");
        }elseif($request->novel != null || $request->novel == 'null'){
            return redirect("admin/novel/$request->novel");
        }
    }
}
