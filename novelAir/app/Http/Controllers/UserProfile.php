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

            $data["novels"] = Novel:: where("user_id",$id)->get();

            $data["user"] = User:: where("id",$id)->first();






        } else {
            return redirect("/dashboard");
        }

        return view('user.main',$data);
    }

    public function settingsIndex($config = "null"){ 
        if($config == 'personal'){
            $data['config'] = 'personal';
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
            return redirect('user/settings/personal');
        }
        return view('user.settings',$data);
    }

    public function userUpdate(Request $request){
        $request->validate([
            'username' => 'string|max:255',
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'birth_date' => 'date',
            'email' => 'string|email|max:255|unique:users',
            'profileImage' => 'mimes:jpeg,jpg,png|max:1024|dimensions:ratio=1/1,max_width=1500',
        ]);
        
        if(Auth::user()->username == $request->username){

        } else if($request->username == ""){
            
        } else {

        }

        if(Auth::user()->name == $request->name){
            
        } else if($request->name == ""){
             
        } else {

        }

        if(Auth::user()->surname == $request->surname){

        } else if($request->surname == ""){
             
        } else {

        }

        if(Auth::user()->birth_date == $request->birth_date){

        } else if($request->birth_date == ""){
             
        } else {

        }

        if(Auth::user()->email == $request->email){

        } else if($request->email == ""){
             
        } else {

        }

        
        return redirect('user/settings/personal');
    }
}
