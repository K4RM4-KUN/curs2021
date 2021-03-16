<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessageNotification;
use App\Events\publicWall;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["user_id"] = Auth::user()->id;

        $olds = Message::with("comments")->
        withCount("comments")->
        withCount("likes")->
        with('likes')->
        where("to","_public_channel_")->
        orderbydesc('created_at')->
        get();
        //print($olds);
        $data["old"] = $olds;

        $users = User::select("id","name")->where("id","!=",Auth::user()->id)->get();
        $data["users"] = $users;

        $nameOfUser = User::select("name")->where("id",Auth::user()->id)->get();
        $data["user_name"] = $nameOfUser;

        return view('facebook', $data);
    }
    public function ChannelIndex($to){   
        if($to == "_public_channel_"){
            $olds = Message::Where('to', $to)->orderByDesc('created_at')->get();
        }else{
            $olds = Message::where('from', Auth::user()->id)->Where('to', $to)->orWhere(function($query) use ($to) {
                $query->where('from', $to) ->Where('to', Auth::user()->id);})->get();
        }
        $data["old"] = $olds;

        $users = User::select("id","name")->where("id","!=",Auth::user()->id)->get();
        $data["users"] = $users;

        $nameOfUser = User::select("name")->where("id",Auth::user()->id)->get();
        $data["user_name"] = $nameOfUser;
  
        return $data;
    }
    public function like(Request $request){
        $message = new Like;
        $message->setAttribute('message_id', $request->input('postId'));
        $message->setAttribute('user_id', $request->input('userId'));
        if(!Like::where('message_id', $request->input('postId'))->where('user_id', $request->input('userId'))->exists()){
            $message->save();
        } else {
            Like::where('message_id',$request->input('postId'))->where('user_id', $request->input('userId'))->delete();
        }
    }
    
    public function comment(Request $request){
        $message = new Comment;
        $message->setAttribute('message_id', $request->input('postId'));
        $message->setAttribute('user_id', $request->input('userId'));
        $message->setAttribute('comment', $request->input('comment'));
        $message->save();
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

    public function send(Request $request)
    {
        // ...
        // message is being sent
        $request->validate([
            'message' => 'required'
        ]);
        $message = new Message;
        if($request->image != "undefined"){
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            $fileA = $request->file('image');
            $nameA = time().$fileA->getClientOriginalName();
            $fileA->move(public_path().'/img/',$nameA);
            $message->setAttribute('img_route', $nameA);
            $resp["route"] = $nameA;
        }
        $message->setAttribute('from', $request->input('from'));
        $message->setAttribute('to', $request->input('to'));
        $message->setAttribute('message', $request->input('message'));
        $message->save();
        
        if($request->input('to') == "_public_channel_"){
            // want to broadcast publicWall event
            event(new publicWall($message));
        } else {
            // want to broadcast NewMessageNotification event
            event(new NewMessageNotification($message));
        }
        // ...
        $resp["message_id"] = $message->id;
        return $resp;
    }

}
