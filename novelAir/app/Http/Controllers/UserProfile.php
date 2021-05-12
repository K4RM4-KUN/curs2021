<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\Novel;
use App\Models\Author;
use App\Models\Donation;
use App\Models\User_Role;
use App\Models\Role;
use App\Models\Mark;
use App\Models\Subscription;
use App\Models\Chapter;
use App\Models\UNS;
use App\Models\States;
use App\Models\Follow;
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
            $data["user"] = User:: where("id",$id)->first();

            $path = public_path() ."/users/". $data["user"]->id; 
            if(file_exists( $path."/profile/usericon". $data["user"]->imgtype)){ 
                $data['image'] = "users/". $data["user"]->id."/profile/usericon". $data["user"]->imgtype;
            } else {
                $data['image'] = 'images/noimage.png';
            }
            $data["novels"] = Novel:: where([["user_id",$id],["public",1]])->get();
    

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

            $data["profile"] = Profile:: where([["user_id",$id]])->first();
            $num = Follow::where([['user_id',$id]])->get();
            $data["followersNum"] = count($num);
            if(Follow::where([['follower_id',Auth::user()->id],['user_id',$id]])->exists()){
                $data["followUser"] = true;
            }else{
                $data["followUser"] = false;
            }

            $x['list'] = $data["profile"]->state_id;
            $x['user'] = $id;
            $data["novelsList"] = Novel::whereHas('uns', function ($query) use ($x){
                return $query->where('user_id',$x['user'])->where('state_id',(States::where('id', $x["list"])->first())->id);
            })->get();


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
            $data["profile"] = Profile::where('user_id',Auth::user()->id)->first();
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists($path."/profile/bgImage". $data["profile"]->imgtype)){ 
                $data['image'] = "users/".Auth::user()->id."/profile/bgImage". $data["profile"]->imgtype;
            } else {
                $data['image'] = 'images/noimage.png';
            }
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
            $data['config'] = 'perfil'; }
        elseif($config == 'subscripciones'){
            $data['subscriptions'] = Subscription::join('users','users.id',"=",'subscriptions.user_id')->where('subscriber_id',Auth::user()->id)->get();
            $data['config'] = 'subscripciones';
        }elseif($config == 'author'){
            if(Author:: where('user_id',Auth::user()->id)->exists()){
                $data['author'] = Author:: where('user_id',Auth::user()->id)->first();
            } else {
                $data['author'] = new Author;
                $data['author']->SetAttribute('paypal',null);   
            }
            $data['role'] = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
            $data['config'] = 'author';
        }elseif($config == 'ayuda'){
            $data['config'] = 'ayuda';
        }elseif($config == 'estadisticas'){
            $data['subscriptions'] =  Subscription::where('user_id',Auth::user()->id)->get();
            $data['follows'] = count(Follow::where([['user_id',Auth::user()->id]])->get());
            $data['donations'] = Donation::where([['user_id',Auth::user()->id]])->get();
            $data['config'] = 'estadisticas';
        }elseif($config == 'contraseña'){
            $data['config'] = 'contraseña';
        }else{
            return redirect('usuario/ajustes/personal');
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
            $save = explode(".",$file->getClientOriginalName());
            $user->imgtype = ".".$save[count($save)-1];
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists(public_path($path."/profile" ))){ 
                File::makeDirectory($path."/profile" , $mode = 0775, true);
            }
            $file->move($path."/profile","usericon".Auth::user()->imgtype);

        }
        //dd($user);
        //File::deleteDirectory(public_path() ."/users/". Auth::user()->id."/profile/usericon".Auth::user()->imgtype);
        $user->save();

        
        return redirect('usuario/ajustes/personal');
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'presentation' => 'string|max:500',
            'twitter' => 'max:255',
            'facebook' => 'max:255',
            'instagram' => 'max:255',
            'patreon' => 'max:255',
            'other' => 'max:255',
            'bgImage' => 'mimes:jpeg,jpg,png|max:2048|dimensions:ratio=16/9,max_width=1920',
        ]);
        $save = Profile::where('user_id',Auth::user()->id)->first();
        if(Profile::where('user_id',Auth::user()->id)->exists()){
            Profile::where('user_id',Auth::user()->id)->delete();
        }

        $newProfile = new Profile;
        $newProfile->SetAttribute('user_id',Auth::user()->id);
        if(isset($request->private)){
            $newProfile->SetAttribute('private',1);
        } else {
            $newProfile->SetAttribute('private',0);
        }
        if(isset($request->showInstagram)){
            $newProfile->SetAttribute('showInstagram',1);
        } else {
            $newProfile->SetAttribute('showInstagram',0);
        }
        if(isset($request->showPatreon)){
            $newProfile->SetAttribute('showPatreon',1);
        } else {
            $newProfile->SetAttribute('showPatreon',0);
        }
        if(isset($request->showTwitter)){
            $newProfile->SetAttribute('showTwitter',1);
        } else {
            $newProfile->SetAttribute('showTwitter',0);
        }
        if(isset($request->showFace)){
            $newProfile->SetAttribute('showFace',1);
        } else {
            $newProfile->SetAttribute('showFace',0);
        }
        if(isset($request->showOther)){
            $newProfile->SetAttribute('showOther',1);
        } else {
            $newProfile->SetAttribute('showOther',0);
        }
        if(isset($request->bgImage)){ 
            $file = $request->file('bgImage');
            $save = explode(".",$file->getClientOriginalName());
            $newProfile->SetAttribute('imgtype',".".$save[count($save)-1]); 
            $path = public_path() ."/users/". Auth::user()->id; 
            if(file_exists(public_path($path."/profile" ))){ 
                File::makeDirectory($path."/profile" , $mode = 0775, true);
            }
            $file->move($path."/profile","bgImage".Auth::user()->imgtype);
        } else{  
            $newProfile->SetAttribute('imgtype',$save->imgtype); 
        }
        if(isset($request->presentation)){
            $newProfile->SetAttribute('presentation',$request->presentation);
        } 
        if(isset($request->lista)){
            $newProfile->SetAttribute('state_id',$request->lista);
        } 
        if(isset($request->twitter)){
            $newProfile->SetAttribute('twitter',$request->twitter);
        } 
        if(isset($request->face)){
            $newProfile->SetAttribute('facebook',$request->face);
        } 
        if(isset($request->instagram)){
            $newProfile->SetAttribute('instagram',$request->instagram);
        } 
        if(isset($request->patreon)){
            $newProfile->SetAttribute('patreon',$request->patreon);
        } 
        if(isset($request->other)){
            $newProfile->SetAttribute('other',$request->other);
        } 
        $newProfile->save() ;

        return redirect('usuario/ajustes/perfil');
    }

    public function followUser($id = null){
        if ($id != null){
            if(Follow::where([['follower_id',Auth::user()->id],['user_id',$id]])->exists()){
                Follow::where([['follower_id',Auth::user()->id],['user_id',$id]])->delete();
            }else{
                $newProfile = new Follow;

                $newProfile->SetAttribute('follower_id',Auth::user()->id);
                $newProfile->SetAttribute('user_id',$id);

                $newProfile->save();
            }
        }else{
            return redirect("/dashboard");
        }

        return redirect("perfil/".$id."/user");
    }

    public function allUsers(){
        $data["users"] = User::with('profile')->get();
        $data["usersSearch"] = null;

        return view('user.searchUser',$data);
    }

    public function allUsersSearch(Request $request){
        $data["users"] = User::with('profile')->get();

        $data["usersSearch"] = User::with('profile')->where('username', 'like', '%' . $request->searcher . '%')->get();

        

        return view('user.searchUser',$data);
    }

    public function changePassword(Request $request){ 
        $request->validate([
            'newPassword' => 'required|min:8|required_with:newPasswordRepeat|same:newPasswordRepeat',
        ]); 
        $user = User::where('id',Auth::user()->id)->first();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect('usuario/ajustes/personal');
    }

    public function authorConfig(Request $request){ 
        $request->validate([
            'paypal' => 'string|max:400'
        ]);
        if(Author::where('user_id',Auth::user()->id)->exists()){ 
            $update = Author::where('user_id',Auth::user()->id)->first();
            if(isset($request->subscriptions)){
                $update->subscriptions = 1;
            } else {
                $update->subscriptions = 0;
            }
            if(isset($request->donations)){
                $update->donations = 1;
            } else {
                $update->donations = 0;
            } 
            if(isset($request->paypal)){
                $update->paypal = $request->paypal;
            } 
            $update->save();
        }else{
            $newAuthor = new Author;
            if(isset($request->subscriptions)){
                $newAuthor->SetAttribute('subscriptions',1);
            } else {
                $newAuthor->SetAttribute('subscriptions',0);
            }
            if(isset($request->donations)){
                $newAuthor->SetAttribute('donations',1);
            } else {
                $newAuthor->SetAttribute('donations',0);
            } 
            if(isset($request->paypal)){
                $newProfile->SetAttribute('paypal',$request->paypal);
            } 
            $newProfile->save(); 
        }
        return redirect('usuario/ajustes/author');
    }
    public function verificationRequest(Request $request){
        return redirect('usuario/ajustes/author');
    }
}
