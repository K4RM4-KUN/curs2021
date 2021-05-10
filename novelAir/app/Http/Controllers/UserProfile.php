<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Novel;
use App\Models\Mark;
use App\Models\Chapter;
use App\Models\UNS;
use App\Models\States;
use File;

class UserProfile extends Controller
{
    //
    public function profileIndex($id = null,$username = null){
        if($id != null && $username != null){
            if($id == Auth::user()->id){
                $data['myProfile'] = true;
            } else {
                $data['myProfile'] = false;
            }
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists( $path."/profile/usericon". Auth::user()->imgtype)){ 
                $data['image'] = "users/".Auth::user()->id."/profile/usericon". Auth::user()->imgtype;
            } else {
                $data['image'] = 'images/noimage.png';
            }
            $data["novels"] = Novel:: where([["user_id",$id],["public",1]])->get();

            $data["user"] = User:: where("id",$id)->first();

            foreach($data["novels"] as $novel){
                
                //Nota
                $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
                $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();
                if(count($pos)+count($neg) != 0){
                    $novel->SetAttribute('mark',round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));
                } else {
                    $novel->SetAttribute('mark',0);
                }
            }




        } else {
            return redirect("/dashboard");
        }

        return view('user.main',$data);
    }

    public function settingsIndex($config = "null"){ 
        if($config == 'personal'){
            $data['config'] = 'personal';
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists( $path."/profile/usericon". Auth::user()->imgtype)){ 
                $data['image'] = "users/".Auth::user()->id."/profile/usericon". Auth::user()->imgtype;
            } else {
                $data['image'] = 'images/noimage.png';
            }
        }elseif($config == 'perfil'){
            $data['lists'] = States::all();
            foreach($data['lists']  as $list){
                switch($list->state_name){
                    case "following":
                        $list->state_name = "Siguiendo";
                        break;
                    case "pending":
                        $list->state_name = "Pendientes";
                        break;
                    case "abandoned":
                        $list->state_name = "Abandonados";
                        break;
                    case "readed":
                        $list->state_name = "Leidos";
                        break;
                    case "favorite":
                        $list->state_name = "Favoritos";
                        break;
                }
            }
            $data['config'] = 'perfil';
        }elseif($config == 'preferencias'){
            $data['config'] = 'preferencias';
        }elseif($config == 'author'){
            $data['config'] = 'author';
        }elseif($config == 'ayuda'){
            $data['config'] = 'ayuda';
        }else{
            return redirect('usuario/ajustes/personal');
        }
        return view('user.settings',$data);
    }

    public function userUpdate(Request $request){
        File::deleteDirectory(public_path() ."/users/". Auth::user()->id."/profile");
        $request->validate([
            'username' => 'string|max:255',
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'birth_date' => 'date',
            'email' => 'string|email|max:255|unique:users',
            'profileImage' => 'mimes:jpeg,jpg,png|max:1024|dimensions:ratio=1/1,max_width=1500',
        ]);

        $user = User::find(Auth::user()->id);

        if(isset($request->username)){
            $user->username = $request->username;
        } 

        if(isset($request->name)){
            $user->name = $request->name;
        } 

        if(isset($request->surname)){
            $user->surname = $request->surname;
        } 

        if(isset($request->birth_date)){
            $user->birth_date = $request->birth_date;
        } 

        if(isset($request->email)){
            $user->email = $request->email;
        }

        if(isset($request->profileImage)){
            $file = $request->file('profileImage');
            $user->imgtype = ".".explode(".",$file->getClientOriginalName())[1];
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists(public_path($path."/profile" ))){ 
                File::makeDirectory($path."/profile" , $mode = 0775, true);
            }
            $file->move($path."/profile","usericon".Auth::user()->imgtype);

        }
        //dd($user);
        $user->save();

        
        return redirect('usuario/ajustes/personal');
    }
}
