<?php

namespace App\Http\Controllers;

use http\Message\Body;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function mailsend()
    {
        $mailTecnico =  request()->all()['mail'];
        \Mail::to($mailTecnico)->send(new SendMail());
        return '/';
    }

    public function nuevoUsuario($email, $nombre)
    {
        $data = array("email" => $email, "nombre" => $nombre);
        Mail::send('emails.nuevo-usuario', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['nombre'])->subject('Bienvenido a Road tech');
        });

    }
}
