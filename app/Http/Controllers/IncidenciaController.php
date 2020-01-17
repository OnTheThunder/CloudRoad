<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\incidencia;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidencias = Incidencia::all();//where(tecnico_id, $tecnico_id)->orderBy('updated_at','desc')->get()
        $user = 2;
        return view('incidencias', ['user' => $user, 'incidencias' => $incidencias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Operador/incidencia_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Registrar un cliente
        $cliente = new Cliente();

        $cliente->nombre = request('nombre');
        $cliente->apellidos = request ('apellidos');
        $cliente->telefono = request ('telefono');
        $cliente->dni = request ('dni');

        $cliente->save();

        //Registrar un vehiculo
        $cliente_dni = request ('dni');
        $cliente_id = Cliente::where('dni', $cliente_dni)->value('id');
        $vehiculo = new Vehiculo();

        $vehiculo->marca = request ('marca');
        $vehiculo->modelo = request ('modelo');
        $vehiculo->matricula = request ('matricula');
        $vehiculo->aseguradora = request ('aseguradora');
        $vehiculo->cliente_id = $cliente_id;

        $vehiculo->save();

        //Registrar una incidencia
        $incidencia = new Incidencia();

        $incidencia->descripcion = request('descripcion');
        $incidencia->estado = "En proceso";
        $incidencia->tipo = request ('tipo');
        $incidencia->cliente_id = $cliente_id;

        $incidencia->save();

        return redirect('/incidencias/create/map');
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

    public function displayMap(){
        return view('Operador/incidencia_ubicacion');
    }
}
