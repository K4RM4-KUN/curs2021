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

class Library extends Controller
{
    //
    public function index($type){        
        if($type == "novelas" || $type == "visual_novels"){

            $data["tags"] = Tag::orderby('tag_name')->get();

            $placebo = new Novel;
            $placebo->SetAttribute('name',null);
            $placebo->SetAttribute('chapters_count',null);
            $placebo->SetAttribute('id',null);
            $data["results"] = [$placebo];

            $value = 0;
            if($type == "visual_novels"){
                $value = 1;
            }
            $data["novels"] = Novel::
            withCount("chapters")->where([['visual_novel',$value],['public',1]])->
            orderbydesc('created_at')->
            get();
            $data["followersStats"] = 0;
            foreach($data["novels"] as $novel){      
                $data["followersStats"] += $novel->uns_count;
                $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
                $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();
                if(count($pos)+count($neg) != 0){
                    $novel->SetAttribute("Mark",((count($pos)*100)/(count($pos)+count($neg)))/10);
                } else {
                    $novel->SetAttribute("Mark",0);
                }
            }
            $data["type"] = $value;
            return view('library.searcher',$data);
        } else {
            return redirect('/dashboard');
        }
    }

    public function resultSercher(Request $request){
        $type = $request->type;
        $data["tags"] = Tag::orderby('tag_name')->get();

        if($type == 0 || $type == 1){
            

            $data["novels"] = Novel::
            withCount("chapters")->where([['visual_novel',$type],['public',1]])->
            orderbydesc('created_at')->
            get();
            $data["followersStats"] = 0;
            foreach($data["novels"] as $novel){      
                $data["followersStats"] += $novel->uns_count;
                $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
                $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();
                if(count($pos)+count($neg) != 0){
                    $novel->SetAttribute("Mark",((count($pos)*100)/(count($pos)+count($neg)))/10);
                } else {
                    $novel->SetAttribute("Mark",0);
                }
            }
            $data["type"] = $type;
        }

        $tmp = Novel::
        withCount("chapters")
        ->where([
            ['public',1],
            ['name', 'like', '%' . $request->searcher . '%'],
            ['visual_novel',$type],
        ]);
        
        if (!(isset($request->both)) && (isset($request->adult_content))){
            $tmp = $tmp->where("adult_content",1);
        }elseif (!(isset($request->both)) && !(isset($request->adult_content))){
            $tmp = $tmp->where("adult_content",0);
        }

        if (!(isset($request->all)) && (isset($request->manhwa))){
            $tmp = $tmp->where("novel_type","manhwa");
        }
        if (!(isset($request->all)) && (isset($request->manhua))){
            $tmp = $tmp->where("novel_type","manhua");
        }
        if (!(isset($request->all)) && (isset($request->manga))){
            $tmp = $tmp->where("novel_type","manga");
        }
        if (!(isset($request->all)) && (isset($request->oneShot))){
            $tmp = $tmp->where("novel_type","oneShot");
        }

        if (!(isset($request->bothE)) && (isset($request->ended))){
            $tmp = $tmp->where("ended",1);
        }elseif (!(isset($request->bothE)) && !(isset($request->ended))){
            $tmp = $tmp->where("ended",0);
        }

        if(isset($request->filtrarTag) && isset($request->tag)){
            $tag = $request->tag;
            $tmp = $tmp->whereHas('tag_novel', function ($query) use ($tag) {
                return $query->where('tag_id',$tag);
            });
        }


        if ($request->order == "desc"){
            $tmp = $tmp->orderbydesc('created_at');
        }elseif ($request->order == "asc"){
            $tmp = $tmp->orderby('created_at');
        }elseif ($request->order == "more"){
            $tmp = $tmp->orderbydesc('chapters_count');
        }elseif ($request->order == "minus"){
            $tmp = $tmp->orderby('chapters_count');
        }elseif ($request->order == "alfaC"){
            $tmp = $tmp->orderbydesc('name');
        }elseif ($request->order == "alfa"){
            $tmp = $tmp->orderby('name');
        }
        $data["results"] = $tmp->get();

        //dd($data["results"]);
        if(count($data["results"]) == 0){
            $placebo = new Novel;
            $placebo->SetAttribute('name',null);
            $placebo->SetAttribute('chapters_count',null);
            $data["results"] = [$placebo];
        }

        return view('library.searcher',$data);
    }
}
