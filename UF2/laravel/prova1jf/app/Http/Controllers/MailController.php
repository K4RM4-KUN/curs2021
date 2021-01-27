<?php
namespace App\Http\Controllers; 

use Mail;
use Illuminate\Http\Request;
use App\Mail\MailHost;

class MailController extends Controller{    
    public function mail()    
    {      
        $text = 'Cloudways';      
        Mail::to('javierfuentesabalo@gmail.com')->send(new MailHost($text));         
        return 'Email sent Successfully';    
    }}

?>