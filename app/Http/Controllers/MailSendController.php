<?php

namespace App\Http\Controllers;

use App\incidencia;
use App\Tecnico;
use App\Vehiculo;
use http\Message\Body;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function mailsend()
    {
        $mailTecnico =  request('mail');

        //Recogemos la ultima incidencia creada para mandar sus datos al correo
        $incidencia = Incidencia::orderBy('created_at', 'desc')->first();
        $nombreTecncico = Tecnico::where('id', $incidencia['tecnico_id'])->get('nombre')[0]['nombre'];
        $vehiculo = Vehiculo::where('id', $incidencia['vehiculo_id'])->get()[0];


        $data = array( 'email' => $mailTecnico, 'from' => 'onthethunder.co@gmail.com',
                        'idIncidencia' => $incidencia['id'],
                        'nombreTecncico' => $nombreTecncico,
                        'vehiculoMarca' => $vehiculo['marca'],
                        'vehiculoModelo' => $vehiculo['modelo'],
                        'vehiculoMatricula' => $vehiculo['matricula']
        );

        Mail::send( 'emails.sendmail', $data, function( $message ) use ($data)
        {
            $message->to( $data['email'] )->from( $data['from'])->subject( 'Nueva Incidencia' );
        });
    }

    public function nuevoUsuario($email, $nombre)
    {
        $data = array("email" => $email, "nombre" => $nombre);
        Mail::send('emails.nuevo-usuario', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['nombre'])->subject('Bienvenido a Road tech');
        });

    }
}
