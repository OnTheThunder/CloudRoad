<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\incidencia;
use App\Tecnico;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Taller;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencias = Incidencia::all();
        $user = 1;
        return view('incidencias', ['user' => $user, 'incidencias' => $incidencias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operador/incidencia_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $oDatosIncidencia
     * @return void
     */
    public function store(Request $request)
    {
        echo "hola";
        return view('/login');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show(incidencia $incidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, incidencia $incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(incidencia $incidencia)
    {
        //
    }


    public function getTalleres(){
        return json_encode(Taller::all());
    }

    public function getTecnicosByTaller($idTaller){
        date_default_timezone_set('Europe/Madrid');

        if(date('H') < 8){
            $turno = 'noche';
        }
        elseif (date('H') < 16){
            $turno = 'manana';
        }
        else{
            $turno = 'tarde';
        }

        $matchThese = ['taller_id' => $idTaller, 'disponibilidad' => 1, 'turno' => $turno];
        $tecnicos = Tecnico::where($matchThese)->get();
        return json_encode($tecnicos);
    }

    public function displayMap(){
        return view('operador/incidencia_ubicacion');
    }

}
