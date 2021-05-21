<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function indexHome($type = null,$end = null){
        if($type == "info"){ 
            $data['type'] = $type;

        } elseif($type == "contactanos"){
            $data['type'] = $type; 
            
        } else {
            return redirect('nosotros/info');

        }

        $data['sended'] = "no"; 
        if($end != null){
            $data['sended'] = "yes"; 
        }

        return view('about.home',$data);
    }

    public function index($type = null){
        if($type == "uso"){ 
            $data['type'] = $type;
            
        } elseif($type == "privacidad"){
            $data['type'] = $type; 

        } elseif($type == "comunidad"){
            $data['type'] = $type;

        } elseif($type == "cookies"){ 
            $data['type'] = $type;

        } else {
            return redirect('terminos/uso');

        }

        return view('about.terms',$data);
    }
}
