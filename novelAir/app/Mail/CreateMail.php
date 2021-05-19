<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateMail extends Mailable
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
        $this->subject = $this->data['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contact');
    }
}
