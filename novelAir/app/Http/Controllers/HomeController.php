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
use App\Models\User_LastView;
use App\Models\Genre;
use Illuminate\Http\Request;
use File;

class HomeController extends Controller
{
    //
    public function index(){
        $route = public_path("/images/homeShow");
        $files = File::files($route);

        $data['covers'] = count($files);
        $data['imgData'] = $files;
        $data["genres"] = Genre::all();
        $data['best'] = Novel::where('public',1)->get(); 

        //dd($data['imgData']);

        foreach($data["best"] as $novel){ 
            //Nota
            $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
            $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();

            if(count($pos)+count($neg) != 0){
                $novel->SetAttribute('mark',round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));

            } else {
                $novel->SetAttribute('mark',0);

            }

        }

        $data['best'] = $data['best']->sortbydesc('mark')->take(6);
        $data["novels"] = Novel::where([['visual_novel',0],['public',1]])->withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->take(6)->get();

        $data["novels"] = $data["novels"]->sortbydesc('uns_count')->take(6);

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

        $data["visual_novels"] = Novel::where([['visual_novel',1],['public',1]])->withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->get(); 

        $data["visual_novels"] = $data["visual_novels"]->sortbydesc('uns_count')->take(6);
        
        foreach($data["visual_novels"] as $novel){
            //Nota
            $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
            $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();

            if(count($pos)+count($neg) != 0){
                $novel->SetAttribute('mark',round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));

            } else {
                $novel->SetAttribute('mark',0);

            }
        }

        $data["last_novels"] = Novel::where([['public',1]])->withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->get(); 

        $data["last_novels"] = $data["last_novels"]->sortbydesc('uns_count')->take(6);

        foreach($data["last_novels"] as $novel){
            //Nota
            $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
            $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();

            if(count($pos)+count($neg) != 0){
                $novel->SetAttribute('mark',round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));

            } else {
                $novel->SetAttribute('mark',0);

            }
        }

        $data['users'] = User::withCount(['follows','follows as follows_count' => function ($query) {
            $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
        }])->orderbydesc('follows_count')->get(10);
        
        $data['users'] = $data['users']->sortbydesc('follows_count')->take(6);

        return view('welcome',$data);
    }
}
