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

            $placebo = new Novel;
            $placebo->SetAttribute('name',null);
            $placebo->SetAttribute('chapters_count',null);
            $data["results"] = [$placebo];

            $value = 0;
            if($type == "visual_novels"){
                $value = 1;
            }
            $data["novels"] = Novel::
            withCount("chapters")->where('visual_novel',$value)->
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

        if($type == 0 || $type == 1){
            

            $data["novels"] = Novel::
            withCount("chapters")->where('visual_novel',$type)->
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
            ['name', 'like', '%' . $request->searcher . '%'],
            ['visual_novel',$type],
        ]);
        //$data["results"] = $tmp->where('name', 'like', '%' . $request->searcher . '%')->get();

        // switch ($request) {
        //     case 0:
        //         $tmp = $tmp->where();
        //     case 1:
        //         echo "i es igual a 1";
        //     case 2:
        //         echo "i es igual a 2";
        // }
        if (!(isset($request->both)) && (isset($request->adult_content))){
            $tmp = $tmp->where("");
        }
        /**if ($request->order == "desc"){
            $data["results"] = Novel::
            withCount("chapters")->
            where('name', 'like', '%' . $request->searcher . '%')->
            orderbydesc('created_at')->
            get();
        }elseif ($request->order == "asc"){
            $data["results"] = Novel::
            withCount("chapters")->
            where('name', 'like', '%' . $request->searcher . '%')->
            orderby('created_at')->
            get();
        }elseif ($request->order == "more"){
            $data["results"] = Novel::
            withCount("chapters")->
            where('name', 'like', '%' . $request->searcher . '%')->
            orderbydesc('chapters_count')->
            get();
        }elseif ($request->order == "minus"){
            $data["results"] = Novel::
            withCount("chapters")->
            where('name', 'like', '%' . $request->searcher . '%')->
            orderby('chapters_count')->
            get();
        }**/

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
