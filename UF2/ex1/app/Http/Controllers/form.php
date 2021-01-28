<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class form extends Controller
{
    function goForm(Request $request){
        return view('form');
    }

    function goResult(Request $request){
        $toValidate = $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $show['email'] = $request -> input('email');

        return view('result',$show);
    }
}
