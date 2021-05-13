<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationTest extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = null; 
    public $data = null;
    public $user = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request,$user)
    {
        $this->data = $request;
        $this->user = $user;
        $this->subject = 'Solicitud de verificación de '.$user->username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $image = $this->data['idPhoto']; 
        $allThing = $this->view('mails.verification')->
            attach($image->getRealPath(), [
                'as' => $image->getClientOriginalName(),
                'mime' => $image->getMimeType(),
        ]);
        if(isset($this->data['content'])){ 
            $files = $this->data['content']; 
            foreach($files as $file){
                $allThing-> attach($file->getRealPath(), [
                        'as' => $file->getClientOriginalName(),
                        'mime' => $file->getMimeType(),
                ]);
            }
        }
        return $allThing;
    }
}
