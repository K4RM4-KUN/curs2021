<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Mark;
use App\Models\UNS;
use App\Models\States;
use Illuminate\Support\Facades\DB;

class NovelManager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data["followers"] = count((UNS::where('novel_id',1)->where("state_id",(States::where('state_name', "following")->first())->id)->get()));
        $data["novels"] = Novel::
        withCount([ 'uns','uns as uns_count' => function ($query) {
            $query->where('state_id',(States::where('state_name', "following")->first())->id);
        }])->
        with("chapters")->
        withSum('chapters', 'views')->
        withCount("chapters")->
        where("user_id",Auth::user()->id)->
        orderbydesc('created_at')->
        get();
        $data["viewStats"] = 0;
        $data["followersStats"] = 0;
        foreach($data["novels"] as $novel){
            $data["viewStats"] += $novel->chapters_sum_views;        
            $data["followersStats"] += $novel->uns_count;
            $pos = Mark::where('novel_id',$novel->id)->where("like",1)->get();
            $neg =  Mark::where('novel_id',$novel->id)->where("like",0)->get();
            if(count($pos)+count($neg) != 0){
                $novel->SetAttribute("Mark", round(((count($pos)*100)/(count($pos)+count($neg)))/10,1));
            } else {
                $novel->SetAttribute("Mark",0);
            }
        }
        return view("novelManager",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
