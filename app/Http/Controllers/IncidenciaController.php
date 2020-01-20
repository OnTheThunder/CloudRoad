<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\incidencia;
use App\Tecnico;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Taller;
use Illuminate\Support\Facades\DB;

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
        //DATOS QUE RECIBIMOS POR AJAX POST
        $datosCliente = request()->all()['cliente'];
        $datosVehiculo = request()->all()['vehiculo'];
        $datosIncidencia = request()->all()['incidencia'];
        $datosCoordenadasIncidencia = request()->all()['coordenadasIncidencia'];
        $datosTecnico = request()->all()['tecnico'];

        //CLIENTE
        //Comprobamos que no exista ya el cliente en DB
        $cliente = DB::table('clientes')->where('dni', $datosCliente['dni'])->get();

        if(count($cliente) == 0){
            $cliente = new Cliente();
            $cliente->nombre = $datosCliente['nombre'];
            $cliente->apellidos = $datosCliente['apellidos'];
            $cliente->telefono = $datosCliente['telefono'];
            $cliente->dni = $datosCliente['dni'];
            $cliente->save();
        }
        //Guardamos el id del cliente para utilizarlo en las fk de otras tablas
        $idCliente = Cliente::where('dni', $datosCliente['dni'])->get('id')[0]['id'];

        //VEHICULO
        //Comprobamos que no exista ya el vehiculo en DB
        $vehiculo = DB::table('vehiculos')->where('matricula', $datosVehiculo['matricula'])->get();

        if(count($vehiculo) == 0){
            $vehiculo = new Vehiculo();
            $vehiculo->matricula = $datosVehiculo['matricula'];
            $vehiculo->modelo = $datosVehiculo['modelo'];
            $vehiculo->marca = $datosVehiculo['marca'];
            $vehiculo->aseguradora = $datosVehiculo['aseguradora'];
            $vehiculo->cliente_id = $idCliente;
            $vehiculo->save();
        }

        //INCIDENCIA
        $incidencia = new Incidencia();
        $incidencia->tipo = $datosIncidencia['tipo'];
        $incidencia->descripcion = $datosIncidencia['descripcion'];
        $incidencia->latitud = $datosCoordenadasIncidencia['latitud'];
        $incidencia->longitud = $datosCoordenadasIncidencia['longitud'];
        $incidencia->provincia = $datosCoordenadasIncidencia['provincia'];
        $incidencia->descripcion = $datosIncidencia['descripcion'];
        $incidencia->cliente_id = $idCliente;
        $incidencia->tecnico_id = $datosTecnico['id'];
        $incidencia->save();
        //$incidencia->operador_id = ; TENEMOS QUE COGER EL ID OPERADOR DE SESION

        //Ponemos el tecnico en estado no disponible
        $tecnico = Tecnico::find($datosTecnico['id']);
        $tecnico->disponibilidad = 0;
        $tecnico->save();


        return request()->all();
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
