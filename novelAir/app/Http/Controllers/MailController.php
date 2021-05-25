<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationTest;
use App\Mail\CreateMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Verification;

class MailController extends Controller
{
    public function verificationRequest(Request $request){ 
        $request->validate([ 
            'names' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'numId' => 'required|string|max:13',
            'idPhoto' => 'required|mimes:jpeg,jpg,png|max:2048',
            'content' => '',
            'content.*' => 'max:4096'
        ]);

        //Hacer que se guarde en la base de datos
        $newVerify = new Verification;
        $newVerify->SetAttribute('user_id',Auth::user()->id);
        $newVerify->SetAttribute('num_id', $request->numId);
        $newVerify->save();

        $user = User::where('id',Auth::user()->id)->first();

        $mail = new VerificationTest($request->all(),$user);

        Mail::to('javierfuenteabalo@gmail.com')->send($mail);

        return redirect('usuario/ajustes/author');
    }

    public function contactRequest(Request $request,$from = null){ 
        $request->validate([ 
            'email' => 'required|max:255',
            'subject' => 'required|max:200|min:5', 
            'message' => 'required|max:600|min:50', 
        ]);

        $user = User::where('id',Auth::user()->id)->first(); 

        $mail = new CreateMail($request->all(),$user);

        if($from != null){
            Mail::to($request->email,'javierfuentesabalo@gmail.com')->send($mail);
            return redirect('admin/user/'.$from);

        }

        Mail::to('javierfuenteabalo@gmail.com')->send($mail);
        
        return redirect('nosotros/contactanos/enviado');
    }
}
