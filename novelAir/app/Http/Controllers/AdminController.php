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
use App\Models\Profile;
use App\Models\TransactionModel;
use File;

class AdminController extends Controller
{
    public function adminIndex(){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        $data['users'] = User::orderbydesc('created_at')->take(24)->get();
        $data["novels"] = Novel::orderbydesc('created_at')->take(24)->get();
        return view('admin.main',$data);
    }

    public function adminSearch(Request $request){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin'){
            if($request->user != null || $request->user == 'null'){
                return redirect("admin/user/$request->user");
            }elseif($request->novel != null || $request->novel == 'null'){
                return redirect("admin/novel/$request->novel");
            }
        }else{
            return redirect("/");
        };
    }

    public function adminUser($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){
            
            $data['user'] = User::where('id',$id)->first();
            $data["novels"] = Novel::where('user_id',$id)->get();
            $data["profile"] = Profile::where("user_id",$id)->first();
            $data['rolUserSearch'] = User_Role::with('role')->where('user_id',$id)->first();
            $data["roles"] = Role::all();
            $data["transactions"] = TransactionModel::where("user_id",$id)->get();

            return view('admin.user',$data);
        }else{
            return redirect("/");
        };
    }

    public function adminNovel($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){

            $data["novel"] = Novel::where('id',$id)->first();
            $data['user'] = User::where('id',$data["novel"]->user_id)->first();
            $data['chapters'] = Chapter::where('novel_id',$data["novel"]->id)->orderby("chapter_n")->paginate(10);

            return view('admin.novel',$data);
        }else{
            return redirect("/");
        };
    }

    public function adminEditUser(Request $request){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin'){
            
            $role = Role::where("rol_name","bloqueado")->first();
            if($request->roles == $role->id){
                return redirect("admin/blockUser/$request->idUser");
            }else{
                $user = User_Role::where("user_id",$request->idUser)->first();
                $user->role_id = $request->roles;
                $user->save();
            }


            return back()->withInput();
        }else{
            return redirect("/");
        };
    }

    public function adminBlockUser($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){

            $role = Role::where("rol_name","bloqueado")->first();

            $user = User_Role::where("user_id",$id)->first();
            $user->role_id = $role->id;
            $user->save();

            $novels = Novel::where("user_id",$id)->get();
            foreach ($novels as $novel) {
                $novel = Novel::where("id",$novel->id)->first();
                $novel->public = 0;
                $novel->save();
            }
            
            return back()->withInput();
        }else{
            return redirect("/");
        };
    }
    
    public function adminRemoveUser($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){
            User::destroy($id);
            File::deleteDirectory("users/$id");
            return redirect('admin');

        }else{
            return redirect("/");
        };
    }

    public function adminBlockNovel($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){

            $novel = Novel::where("id",$id)->first();
            
            if($novel->public == 1){
                $novel->public = 0;
            }else{
                $novel->public = 1;
            }
            $novel->save();

            return back()->withInput();
        }else{
            return redirect("/");
        };
    }

    public function adminRemoveNovel($id = null){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($data['rolUser']->role->rol_name == 'admin' && $id != null){

            $novel = Novel::where("id",$id)->first();

            File::deleteDirectory($novel->novel_dir);
            Novel::destroy($id);
            return redirect('admin');

        }else{
            return redirect("/");
        };
    }
}
