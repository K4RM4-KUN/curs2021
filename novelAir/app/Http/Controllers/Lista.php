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

class Lista extends Controller
{
    //
    public function index($list = "default",$filter = null){
        $data["followers"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "following")->first())->id)->get()));
        $data["readed"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "readed")->first())->id)->get()));
        $data["abandoned"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "abandoned")->first())->id)->get()));
        $data["pending"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "pending")->first())->id)->get()));
        $data["favorite"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "favorite")->first())->id)->get()));
        $data["list_type"] = $list;
        $data["filterIs"] = $filter;

        if(States::where('state_name', $list)->exists()){
            $data["novels"] =  Novel::whereHas('uns', function ($query) use ($list){
                return $query->where('user_id',Auth::user()->id)->where('state_id',(States::where('state_name', $list)->first())->id);
            })->where('public',1)->get();

            foreach($data["novels"] as $key=>$novel){

                $chapt = Chapter::where([['novel_id',$novel->id],['public',1]])->orderbydesc('chapter_n')->first();
                $last = User_LastView::where([['user_id', Auth::user()->id],['novel_id',$novel->id]])->get();

                if(count($last) != 0 && $chapt->chapter_n <= $last[0]->chapter_n && $filter != "all"){
                
                    if($chapt->chapter_n <= $last[0]->chapter_n){
                        unset($data["novels"][$key]);

                    }

                } else {
                    //Ultimo capitulo
                    if($chapt == null){
                        $novel->SetAttribute('lastchapter',0);
                        if($filter != "all" ){
                            unset($data["novels"][$key]);
                        }
    
                    } else {
                        $novel->SetAttribute('lastchapter',$chapt->chapter_n);
                        $novel->SetAttribute('lastnovels',$chapt->created_at);
    
                    }
    
                    //Ultimo capitulo leido
                    if(count($last) == 0){
                        $novel->SetAttribute('lastview',0);
    
                    } else {
                        $novel->SetAttribute('lastview',$last[0]->chapter_n);
    
                    }

                    //Nota
                    $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
                    $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();

                    if(count($pos)+count($neg) != 0){
                        $novel->SetAttribute('mark',round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));

                    } else {
                        $novel->SetAttribute('mark',0);

                    }

                }
                
            }

            $data['novels'] = $data['novels']->sortbydesc('lastnovels');

        } else {
            return redirect(url('listas/following'));

        }
        
        //dd($data['novels']);
        return view('list.lists',$data);
    }
}

