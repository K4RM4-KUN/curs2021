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
    public function index($list = "default"){

        $data["followers"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "following")->first())->id)->get()));
        $data["readed"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "readed")->first())->id)->get()));
        $data["abandoned"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "abandoned")->first())->id)->get()));
        $data["pending"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "pending")->first())->id)->get()));
        $data["favorite"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "favorite")->first())->id)->get()));

        $data["lastViews"] = User_LastView::where([
            ['user_id', Auth::user()->id],
        ])->get();

        //$data["lastChapter"] = Chapter::where()->get();

        if(States::where('state_name', $list)->exists()){
            $data["novels"] =  Novel::withCount('chapters')->whereHas('uns', function ($query) use ($list){
                return $query->where('user_id',Auth::user()->id)->where('state_id',(States::where('state_name', $list)->first())->id);
            })->get();
        } else {
            return redirect(url('listas/following'));
        }

        return view('list.lists',$data);
    }

    public function test($list = "default"){

        $data["followers"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "following")->first())->id)->get()));
        $data["readed"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "readed")->first())->id)->get()));
        $data["abandoned"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "abandoned")->first())->id)->get()));
        $data["pending"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "pending")->first())->id)->get()));
        $data["favorite"] = count((UNS::where('user_id',Auth::user()->id)->where("state_id",(States::where('state_name', "favorite")->first())->id)->get()));
        $data["list_type"] = $list;

        $data["lastViews"] = User_LastView::where([
            ['user_id', Auth::user()->id],
        ])->get();

        //$data["lastChapter"] = Chapter::where()->get();

        if(States::where('state_name', $list)->exists()){
            $data["novels"] =  Novel::withCount('chapters')->
            whereHas('uns', function ($query) use ($list){
                return $query->where('user_id',Auth::user()->id)->where('state_id',(States::where('state_name', $list)->first())->id);
            })->get();
        } else {
            return redirect(url('test/following'));
        }

        return view('list.listsNew',$data);
    }
}
