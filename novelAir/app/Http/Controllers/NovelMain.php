<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Novel;
use App\Models\Mark;
use App\Models\Chapter;
use App\Models\UNS;
use App\Models\States;
use App\Models\Tag;
use App\Models\Tag_Novel;
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

        $data["author"] = User::select('username','id','imgtype','created_at')->where("id",$data["novel"][0]->user_id)->get();

        $data["tags"] = DB::table("tags_novels")->join('tags',"tags_novels.tag_id","=","tags.id")->where("novel_id",$id)->get();

        $tmp = Chapter:: where([
            ["novel_id", $id],
        ]);
        
        if($order == "desc"){
            $data["chaptersOrder"] = $order;
            $data["chapters"] = $tmp->orderbydesc('chapter_n')->get();
        } else {
            $data["chaptersOrder"] = $order;
            $data["chapters"] = $tmp->orderby('chapter_n')->get();
        }
        

        if(Auth::check()){
            $data["liked"] = Mark::where("user_id", Auth::user()->id)->where("novel_id",$id)->first();
            if($data["liked"] == null){
                $liked = new Mark;
                $liked->SetAttribute("like",3);
                $data["liked"] = $liked;
            }
            $tmp = UNS::where("user_id", Auth::user()->id)->where("novel_id",$id)->first();
    
            if($tmp == null){
                $state = new States;
                $state->SetAttribute("state_name","none");
                $data["userUNS"] = [$state];
            } else {
                $data["userUNS"] = States::where("id",$tmp->state_id)->get();
            }
            $data["views"] = User_LastView:: where([
                ["user_id", Auth::user()->id],
                ["novel_id", $id],
            ])->get();
            
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

            }else{  //entra si no has empezado a ller la novela
                $data["lastView"] = $data["chapters"][count($data["chapters"])-1]->chapter_n;
            }
            
        } else {
            $state = new States;
            $state->SetAttribute("state_name","none");
            $data["userUNS"] = [$state];
            $liked = new Mark;
            $liked->SetAttribute("like",3);
            $data["liked"] = $liked;
        }

        $data["followers"] = count(
            (UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "following")->first())->id)->get())
        );
        $data["readed"] = count(
            (UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "readed")->first())->id)->get())
        );
        $data["abandoned"] = count(
            (UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "abandoned")->first())->id)->get())
        );
        $data["pending"] = count(
            (UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "pending")->first())->id)->get())
        );
        $data["favorite"] = count(
            (UNS::where('novel_id',$id)->where("state_id",(States::where('state_name', "favorite")->first())->id)->get())
        );

        $pos = Mark::where('novel_id',$id)->where("like",1)->get();
        $neg =  Mark::where('novel_id',$id)->where("like",0)->get();
        if(count($pos)+count($neg) != 0){
            $data["mark"] = round(((count($pos)*100)/(count($pos)+count($neg)))/10,1);
        } else {
            $data["mark"] = 0;
        }

        $data['featureds'] = Novel::where("visual_novel",$data["novel"][0]->visual_novel)->withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->orderbydesc('uns_count')->get(10); 
        

        return view('novel.main',$data);
    }
    
    public function deleteMark($id){
        User_LastView:: where([['novel_id',$id],['user_id',Auth::user()->id]])->delete();
        return redirect('novel/'.$id);
    }

    public function readIndex($id_novel,$id_chapter){
        $data["novel"] = Novel::where("id",$id_novel)->get();
        $data["chapter"] = Chapter::where([
            ["novel_id", $id_novel],
            ["chapter_n", $id_chapter]
        ])->get();

        $data["chapters"] = Chapter:: where([
            ["novel_id", $id_novel],
        ])->orderbydesc('chapter_n')->get();

        $data["content"] = File::files(public_path()."/".$data["chapter"][0]->route);
        
        if(Auth::check()){
            $tmpChapter = Chapter::find($data["chapter"][0]->id);
            $tmpChapter->views = ($data["chapter"][0]->views+1);
            $tmpChapter->save();

            $existViewLast = User_LastView::where([
                ['user_id', Auth::user()->id],
                ['novel_id', $id_novel],
            ])->get();
            
            if (count($existViewLast) == 0){
                $viewLast = new User_LastView;
                $viewLast->setAttribute('user_id', Auth::user()->id);
                $viewLast->setAttribute('novel_id', $id_novel);
                $viewLast->setAttribute('chapter_n', $data["chapter"][0]->chapter_n);
                $viewLast->save();
            }elseif ($existViewLast[0]->chapter_n < $data["chapter"][0]->chapter_n){
                $existViewLast[0]->chapter_n = $data["chapter"][0]->chapter_n;
                $existViewLast[0]->save();
            }
        } else{

        }


        return view('novel.read',$data);
    }

    //Interaction
    public function novelInteraction($type,$novel_id){	
        $state_id = States::where('state_name', $type)->first();
        $alredyState = UNS::where([['user_id', Auth::user()->id],['novel_id',$novel_id]])->first();
        if($alredyState == null){
            $state = new UNS;
            $state->setAttribute('user_id', Auth::user()->id);
            $state->setAttribute('novel_id', $novel_id);
            $state->setAttribute('state_id', $state_id->id);
            $state->save();
        }else if($state_id->id == $alredyState->state_id){
            UNS::
            where([
                ["user_id", Auth::user()->id],
                ['novel_id', $novel_id]
            ])
            ->delete();
        } else{
            $alredyState->state_id = $state_id->id;
            $alredyState->save();
        }
        return redirect('novel/'.$novel_id);
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
