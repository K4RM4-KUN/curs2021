<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formController extends Controller
{
    function goForm(Request $request){
        return view('form');
    }

    function goResult(Request $request){
        $toValidate = $request->validate([
            'email' => 'required|email',
            'nif' => 'required|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
            'data' => 'file|max:1024',
            'imageData' => 'image|dimensions:min_width=1920,min_height=1080'
        ]);

        $show['email'] = $request -> input('email');
        $show['nif'] = $request -> input('nif');

        return view('result',$show);
    }
}
