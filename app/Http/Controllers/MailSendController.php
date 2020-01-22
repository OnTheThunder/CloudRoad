<?php

namespace App\Http\Controllers;

use http\Message\Body;
use Illuminate\Http\Request;
use App\Mail\SendMail;

class MailSendController extends Controller
{
    public function mailsend()
    {
        \Mail::to('adrianf1team@gmail.com')->send(new SendMail());
        //return view('datos'); //Vista a la que te redirecciona tras enviar el correo
    }
}
