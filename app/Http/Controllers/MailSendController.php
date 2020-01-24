<?php

namespace App\Http\Controllers;

use http\Message\Body;
use Illuminate\Http\Request;
use App\Mail\SendMail;

class MailSendController extends Controller
{
    public function mailsend()
    {
        $mailTecnico =  request()->all()['mail'];
        \Mail::to($mailTecnico)->send(new SendMail());
        return '/';
    }
}
