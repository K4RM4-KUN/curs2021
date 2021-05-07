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
    public function index($type = "visual_novels"){
                
        if($type == "novelas" || $type == "visual_novels"){

            $data["tags"] = Tag::orderby('tag_name')->get();
            $filters = array(
                "text" => "",
                "adult_content" => 0,
                "finished"  => 0,
                "order" => 0,
                "tag" => 0,
                "type"  => array(
                    "all" => 0,
                    "manhwa" => 0,
                    "manhua" => 0,
                    "manga" => 0,
                    "oneShot" => 0,
                ),
            );
            $data["filters"] = $filters;

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

        $filters = array(
            "text" => $request->searcher,
            "adult_content" => 0,
            "finished"  => 0,
            "order" => 0,
            "tag" => 0,
            "type"  => array(
                "all" => 0,
                "manhwa" => 0,
                "manhua" => 0,
                "manga" => 0,
                "oneShot" => 0,
            ),
        );
        
        $tmp = Novel::
        withCount("chapters")
        ->where([
            ['public',1],
            ['name', 'like', '%' . $request->searcher . '%'],
            ['visual_novel',$type],
        ]);

        
        if (!(isset($request->both)) && (isset($request->adult_content))){
            $tmp = $tmp->where("adult_content",1);
            $filters["adult_content"] = 1;
        }elseif (!(isset($request->both)) && !(isset($request->adult_content))){
            $tmp = $tmp->where("adult_content",0);
            $filters["adult_content"] = 2;
        }

        if (!(isset($request->all)) && (isset($request->manhwa))){
            $tmp = $tmp->where("novel_type","manhwa");
            $filters["type"]["all"] = 1;
            $filters["type"]["manhwa"] = 1;
            //dd($filters);
        }
        if (!(isset($request->all)) && (isset($request->manhua))){
            $tmp = $tmp->where("novel_type","manhua");
            $filters["type"]["all"] = 1;
            $filters["type"]["manhua"] = 1;
        }
        if (!(isset($request->all)) && (isset($request->manga))){
            $tmp = $tmp->where("novel_type","manga");
            $filters["type"]["all"] = 1;
            $filters["type"]["manga"] = 1;
        }
        if (!(isset($request->all)) && (isset($request->oneShot))){
            $tmp = $tmp->where("novel_type","oneShot");
            $filters["type"]["all"] = 1;
            $filters["type"]["oneShot"] = 1;
        }

        if (!(isset($request->bothE)) && (isset($request->ended))){
            $tmp = $tmp->where("ended",1);
            $filters["finished"] = 1;
            
        }elseif (!(isset($request->bothE)) && !(isset($request->ended))){
            $tmp = $tmp->where("ended",0);
            $filters["finished"] = 2;
        }

        if(isset($request->filtrarTag) && isset($request->tag)){
            $tag = $request->tag;
            $tmp = $tmp->whereHas('tag_novel', function ($query) use ($tag) {
                return $query->where('tag_id',$tag);
            });
            $filters["tag"] = $request->tag;
        }


        if ($request->order == "desc"){
            $tmp = $tmp->orderbydesc('created_at');
            $filters["order"] = 0;
        }elseif ($request->order == "asc"){
            $tmp = $tmp->orderby('created_at');
            $filters["order"] = 1;
        }elseif ($request->order == "more"){
            $tmp = $tmp->orderbydesc('chapters_count');
            $filters["order"] = 2;
        }elseif ($request->order == "minus"){
            $tmp = $tmp->orderby('chapters_count');
            $filters["order"] = 3;
        }elseif ($request->order == "alfaC"){
            $tmp = $tmp->orderbydesc('name');
            $filters["order"] = 5;
        }elseif ($request->order == "alfa"){
            $tmp = $tmp->orderby('name');
            $filters["order"] = 4;
        }

        //dd($filters);
        $data["filters"] = $filters;
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


    //test
    public function indextest2($type = "visual_novels"){
                
        if($type == "novelas" || $type == "visual_novels"){

            $data["tags"] = Tag::orderby('tag_name')->get();
            $filters = array(
                "text" => "",
                "more" => 0,
                "adult_content" => 0,
                "finished"  => 0,
                "order" => 0,
                "tag" => 0,
                "type"  => array(
                    "all" => 0,
                    "typeVN" => "",
                ),
            );
            $data["filters"] = $filters;

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
            return view('library.searcherNew',$data);
        } else {
            return redirect('/dashboard');
        }
    }

    public function resultSerchertest2(Request $request){
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

        $filters = array(
            "text" => $request->searcher,
            "more" => 0,
            "adult_content" => 0,
            "finished"  => 0,
            "order" => 0,
            "tag" => 0,
            "type"  => array(
                "all" => 0,
                "typeVN" => "",
            ),
        );
        
        $tmp = Novel::
        withCount("chapters")
        ->where([
            ['public',1],
            ['name', 'like', '%' . $request->searcher . '%'],
            ['visual_novel',$type],
        ]);

        if (isset($request->more)){

            $filters["more"] = 1;

            if (!(isset($request->both)) && (isset($request->adult_content))){
                $tmp = $tmp->where("adult_content",1);
                $filters["adult_content"] = 1;
            }elseif (!(isset($request->both)) && !(isset($request->adult_content))){
                $tmp = $tmp->where("adult_content",0);
                $filters["adult_content"] = 2;
            }

            if (!(isset($request->all)) && ($request->typeVN == "manhwa")){
                $tmp = $tmp->where("novel_type","manhwa");
                $filters["type"]["all"] = 1;
                $filters["type"]["typeVN"] = "manhwa";
                //dd($filters);
            }
            if (!(isset($request->all)) && ($request->typeVN == "manhua")){
                $tmp = $tmp->where("novel_type","manhua");
                $filters["type"]["all"] = 1;
                $filters["type"]["typeVN"] = "manhua";
            }
            if (!(isset($request->all)) && ($request->typeVN == "manga")){
                $tmp = $tmp->where("novel_type","manga");
                $filters["type"]["all"] = 1;
                $filters["type"]["typeVN"] = "manga";
            }
            if (!(isset($request->all)) && ($request->typeVN == "oneShot")){
                $tmp = $tmp->where("novel_type","oneShot");
                $filters["type"]["all"] = 1;
                $filters["type"]["typeVN"] = "oneShot";
            }

            if (!(isset($request->bothE)) && (isset($request->ended))){
                $tmp = $tmp->where("ended",1);
                $filters["finished"] = 1;
                
            }elseif (!(isset($request->bothE)) && !(isset($request->ended))){
                $tmp = $tmp->where("ended",0);
                $filters["finished"] = 2;
            }

            if(isset($request->filtrarTag) && isset($request->tag)){
                $tag = $request->tag;
                $tmp = $tmp->whereHas('tag_novel', function ($query) use ($tag) {
                    return $query->where('tag_id',$tag);
                });
                $filters["tag"] = $request->tag;
            }


            if ($request->order == "desc"){
                $tmp = $tmp->orderbydesc('created_at');
                $filters["order"] = 0;
            }elseif ($request->order == "asc"){
                $tmp = $tmp->orderby('created_at');
                $filters["order"] = 1;
            }elseif ($request->order == "more"){
                $tmp = $tmp->orderbydesc('chapters_count');
                $filters["order"] = 2;
            }elseif ($request->order == "minus"){
                $tmp = $tmp->orderby('chapters_count');
                $filters["order"] = 3;
            }elseif ($request->order == "alfaC"){
                $tmp = $tmp->orderbydesc('name');
                $filters["order"] = 5;
            }elseif ($request->order == "alfa"){
                $tmp = $tmp->orderby('name');
                $filters["order"] = 4;
            }
        }

        //dd($filters);
        $data["filters"] = $filters;
        $data["results"] = $tmp->get();

        //dd($data["results"]);
        if(count($data["results"]) == 0){
            $placebo = new Novel;
            $placebo->SetAttribute('name',null);
            $placebo->SetAttribute('chapters_count',null);
            $data["results"] = [$placebo];
        }

        return view('library.searcherNew',$data);
    }
}