<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\NewMessageNotification;
use App\Events\publicWall;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $olds = Message::select("message","from","created_at")->
        where("to","_public_channel_")->
        orderbydesc('created_at')->
        get();
        $data["old"] = $olds;

        $users = User::select("id","name")->where("id","!=",Auth::user()->id)->get();
        $data["users"] = $users;
        
        $nameOfUser = User::select("name")->where("id",Auth::user()->id)->get();
        $data["user_name"] = $nameOfUser;

        return view('facebook', $data);
    }
    public function channelIndex(Request $request)
    {
        if($request->input("to") != "_public_channel_"){
            $olds = Message::select("message","from","created_at")->
            where("from",Auth::user()->id)->
            where("to",$request->input("to"))->
            orWhere("from",$request->input("to"))->
            where("to",Auth::user()->
            id)->orderbydesc('created_at')->
            get();
        } else {
            $olds = Message::select("message","from","created_at")->
            where("to","_public_channel_")->
            orderbydesc('created_at')->
            get();
        }
        $data["user_id"] = Auth::user()->id;
        $users = User::select("id","name")->where("id","!=",Auth::user()->id)->get();
        $data["old"] = $olds;
        $data["users"] = $users;

        return view('facebook', $data);
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
        /* $toValidate = $request->validate([
            'message' => 'required'
        ]);*/

        $message = new Message;
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
        return $this->index();
    }

}
