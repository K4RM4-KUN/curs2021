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
    public function index($id){
        //
        $data["novel"] = Novel::where("id",$id)->get();

        $data["author"] = User::select('username','id')->where("id",$data["novel"][0]->user_id)->get();

        $data["tags"] = DB::table("tags_novels")->join('tags',"tags_novels.tag_id","=","tags.id")->where("novel_id",$id)->get();

        $tmp = UNS::where("user_id", Auth::user()->id)->where("novel_id",$id)->first();

        if($tmp == null){
            $state = new States;
            $state->SetAttribute("state_name","none");
            $data["userUNS"] = [$state];
        } else {
            $data["userUNS"] = States::where("id",$tmp->state_id)->get();
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

        $data["chapters"] = Chapter:: where([
            ["novel_id", $id],
        ])->orderbydesc('chapter_n')->get();

        $data["views"] = User_LastView:: where([
            ["user_id", Auth::user()->id],
            ["novel_id", $id],
        ])->get();

        return view('novel.main',$data);
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
}
