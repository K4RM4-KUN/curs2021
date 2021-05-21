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
use App\Models\Verification;
use File;

class AdminController extends Controller
{
    public function adminIndex(){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first(); 
        $data['users'] = User::orderbydesc('created_at')->take(24)->get();
        $data["novels"] = Novel::orderbydesc('created_at')->take(24)->get();
        $data["content"] = File::files(public_path()."/images/homeShow");
        //dd($data["content"]);

        return view('admin.main',$data);
    }

    public function adminSearch(Request $request){
        $data['rolUser'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();

        if($data['rolUser']->role->rol_name == 'admin'){
            //compara si el resultado de la vita es un usuario o una novela
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
            $data["verifications"] = Verification::where("user_id",$id)->get();

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

            //comprueba si el cambio del usuario es un bloqueo de cuenta y lo redirige si no lo es, lo edita en la base de datos
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

            //si el usuario es bloqueado, también se le ponen todas las novelas en privado
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

    public function adminAddImg(Request $request){
        $request->validate([ 
            'content' => 'required',
            'content.*' => 'mimes:jpeg,jpg,png|dimensions:height=475,width=1000|max:2048'
        ]);
        $route = public_path("/images/homeShow/");
        $files = File::files($route);
        $counter = count($files)+1;

        foreach($request->file('content') as $image){ 
             $image->move($route,$counter.".".explode(".", $image->getClientOriginalName())[1]); 
            $counter++;
        }
        return back()->withInput();
    }

    public function adminRmImg($name = null){
        if($name != null){
            if(File::exists(public_path("/images/homeShow/".$name))){
                File::delete(public_path("/images/homeShow/".$name));
                //dd("eliminado");
            }
        }
        return back()->withInput();
    }
}
