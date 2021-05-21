<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Mark;
use App\Models\UNS;
use App\Models\States;
use App\Models\PaymentChapter;
use App\Models\Subscription;
use App\Models\User_Role;
//use App\Models\Tag;
//use App\Models\Tag_Novel;
use App\Models\User_LastView;
use Illuminate\Http\Request;
use File;

class NovelMain extends Controller
{
    public function index($id = "none",$order="desc"){
        //
        if(!Novel::where('id',$id)->exists()){
            return redirect("biblioteca");

        }

        $data["novel"] = Novel::where("id",$id)->get();
        $data["followers"] = count((UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "following")->first())->id)->get()));
        $data["readed"] = count((UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "readed")->first())->id)->get()));
        $data["abandoned"] = count((UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "abandoned")->first())->id)->get()));
        $data["pending"] = count((UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "pending")->first())->id)->get()));
        $data["favorite"] = count((UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "favorite")->first())->id)->get()));
        $data["author"] = User::select('username','id','imgtype','created_at')->where("id",$data["novel"][0]->user_id)->get();
        $data['payment'] = (PaymentChapter::where('novel_id',$data["novel"][0]->id)->first())->payment_chapters;
        $data['genre'] = (Genre::where("id",$data["novel"][0]->genre)->first())->name;
        $data['featureds'] = Novel::where("visual_novel",$data["novel"][0]->visual_novel)->withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->orderbydesc('uns_count')->get(10); 
        //$data["tags"] = DB::table("tags_novels")->join('tags',"tags_novels.tag_id","=","tags.id")->where("novel_id",$id)->get();

        $pos = Mark::where('novel_id',$id)->where("like",1)->get();
        $neg =  Mark::where('novel_id',$id)->where("like",0)->get();

        if(count($pos)+count($neg) != 0){
            $data["mark"] = round(((count($pos)*100)/(count($pos)+count($neg)))/10,1);

        } else {
            $data["mark"] = 0;

        }

        $path = public_path() ."/users/". $data["author"][0]->id; 
        $tmp = Chapter:: where([
            ["novel_id", $id],
            ['public',1]
        ]);
        
        if(file_exists( $path."/profile/usericon". $data["author"][0]->imgtype)){ 
            $data['image'] = "users/". $data["author"][0]->id."/profile/usericon". $data["author"][0]->imgtype;

        } else {
            $data['image'] = 'images/noimage.png';
            //dd($data['image'],file_exists( $path."/profile/usericon". $data["author"][0]->imgtype));

        }
        
        if($order == "desc"){
            $data["chaptersOrder"] = $order;
            $data["chapters"] = $tmp->orderbydesc('chapter_n')->get();

        } else {
            $data["chaptersOrder"] = $order;
            $data["chapters"] = $tmp->orderby('chapter_n')->get();

        }

        if(Auth::check()){
            $data["liked"] = Mark::where("user_id", Auth::user()->id)->where("novel_id",$id)->first();
            $data["views"] = User_LastView:: where([
                ["user_id", Auth::user()->id],
                ["novel_id", $id],
            ])->get();

            $tmp = UNS::where("user_id", Auth::user()->id)->where("novel_id",$id)->first();

            if($data["liked"] == null){
                $liked = new Mark;
                $liked->SetAttribute("like",3);

                $data["liked"] = $liked;

            }
    
            if($tmp == null){
                $state = new States;
                $state->SetAttribute("state_name","none");

                $data["userUNS"] = [$state];

            } else {
                $data["userUNS"] = States::where("id",$tmp->state_id)->get();

            }
            
            
            if(count($data['views']) == 0){
                $data['actualChapter'] = null;

            } elseif(count($data['views']) != 0){
                $data['actualChapter'] = $data['views'][0]->chapter_n;

            }

            if (count($data["chapters"]) == 0){ //entra si la novela no tiene capitulos
                $data["lastView"] = null;

            }elseif (count($data["views"])==1){ //entra al ultimo capitulo leido
                $data["lastView"] = $data["views"][0]->chapter_n; //coge el capitulo de la DB
                
                $chapterIndex = false;

                foreach ($data["chapters"] as $ch){ //forech de todos los capitulos
                    if ($ch->chapter_n == $data["lastView"]+1){
                        $chapterIndex = true;

                    }

                }

                if ($chapterIndex){
                    $data["lastView"] = $data["lastView"]+1;

                }else {
                    $data["lastView"] = null;

                }

            }else{  //entra si no has empezado a leer la novela
                $data["lastView"] = $data["chapters"][count($data["chapters"])-1]->chapter_n;

            }

            $data['subscribed'] = Subscription::where([['subscriber_id',Auth::user()->id],['caducate_at',">",date("Y-m-d H:i:s")],['user_id',$data['novel'][0]->user_id]])->exists();
            if(Auth::user()->id == $data["author"][0]->user_id || User_Role::where([['user_id',Auth::user()->id],['role_id',3]])->exists()){
                $data['subscribed'] = true;
            }

        } else {
            $state = new States;
            $state->SetAttribute("state_name","none");
            $liked = new Mark;
            $liked->SetAttribute("like",3);

            $data["liked"] = $liked;
            $data["userUNS"] = [$state];
            $data['actualChapter'] = null;
            $data['subscribed'] = false;

            if(count($data["chapters"]) == 0){
                $data["lastView"] = 0;

            } else {
                $data["lastView"] = $data["chapters"][count($data["chapters"])-1]->chapter_n;

            }
            
        }
        
        return view('novel.main',$data);
    }
    
    public function deleteLastView($id){
        User_LastView:: where([['novel_id',$id],['user_id',Auth::user()->id]])->delete();

        return redirect('novel/'.$id);
    }

    public function readIndex($id,$id_chapter){
        $data["novel"] = Novel::where("id",$id)->get();
        $data["chapter"] = Chapter::where([
            ["novel_id", $id],
            ["chapter_n", $id_chapter]
        ])->get();
        $data["chapters"] = Chapter:: where([
            ["novel_id", $id],
            ["public", 1],
        ])->orderbydesc('chapter_n')->get();
        $data["content"] = File::files(public_path()."/".$data["chapter"][0]->route);
        
        if(Auth::check()){
            $tmpChapter = Chapter::find($data["chapter"][0]->id);
            $tmpChapter->views = ($data["chapter"][0]->views+1);
            $tmpChapter->save();

            $existViewLast = User_LastView::where([
                ['user_id', Auth::user()->id],
                ['novel_id', $id],
            ])->get();
            
            if (count($existViewLast) == 0){
                $viewLast = new User_LastView;
                $viewLast->setAttribute('user_id', Auth::user()->id);
                $viewLast->setAttribute('novel_id', $id);
                $viewLast->setAttribute('chapter_n', $data["chapter"][0]->chapter_n);
                $viewLast->save();

            }elseif ($existViewLast[0]->chapter_n < $data["chapter"][0]->chapter_n){
                $existViewLast[0]->chapter_n = $data["chapter"][0]->chapter_n;
                $existViewLast[0]->save();
            }

        }

        return view('novel.read',$data);
    }

    //Interaction
    public function novelInteraction($type,$id){	
        $state_id = States::where('state_name', $type)->first();
        $alredyState = UNS::where([['user_id', Auth::user()->id],['novel_id',$id]])->first();

        if($alredyState == null){
            $state = new UNS;
            $state->setAttribute('user_id', Auth::user()->id);
            $state->setAttribute('novel_id', $id);
            $state->setAttribute('state_id', $state_id->id);
            $state->save();

        }else if($state_id->id == $alredyState->state_id){
            UNS::where([
                ["user_id", Auth::user()->id],
                ['novel_id', $id]
            ])->delete();

        } else{
            $alredyState->state_id = $state_id->id;
            $alredyState->save();

        }

        return redirect('novel/'.$id);
    }

    public function voteNovel($id,$vote){
        $alredyVoted = Mark::where([["user_id",Auth::user()->id],["novel_id",$id]])->first();
        
        if($vote == "pos" || $vote == "neg"){
            $value = 0;

            if($vote == "pos"){
                $value = 1;

            }

            if($alredyVoted == null){
                $newVote = new Mark;
                $newVote->SetAttribute("novel_id",$id);
                $newVote->SetAttribute("user_id",Auth::user()->id);
                $newVote->SetAttribute("like",$value);
                $newVote->save();

            } else if($alredyVoted->like == $value) {
                Mark::where([["user_id", Auth::user()->id],['novel_id', $id]])->delete();

            } else {
                $alredyVoted->like = $value;
                $alredyVoted->save();

            }

        }

        return redirect("novel/".$id);
    }
}
