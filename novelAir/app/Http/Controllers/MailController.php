<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationTest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $user = User::where('id',Auth::user()->id)->first();
        $mail = new VerificationTest($request->all(),$user);
        Mail::to('javierfuenteabalo@gmail.com')->send($mail);

        return redirect('usuario/ajustes/author');
    }
}
