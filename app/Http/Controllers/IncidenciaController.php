<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\incidencia;
use App\Operario;
use App\Tecnico;
use App\Vehiculo;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Taller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

        //Get id de las fk para asignarlas a la incidencia
        $vehiculoId = Vehiculo::where('matricula', $datosVehiculo['matricula'])->get('id');
        $operadorId = Operario::where('usuarios_id', Auth::user()->id)->get('id');

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
        $incidencia->vehiculo_id = $vehiculoId[0]['id'];
        $incidencia->operador_id = $operadorId[0]['id'];
        $incidencia->save();

        //Ponemos el tecnico en estado no disponible
        $tecnico = Tecnico::find($datosTecnico['id']);
        $tecnico->disponibilidad = 0;
        $tecnico->save();

        //COMENTARIOS
        //INSERT COMENTARIO INCIDENCIA CREADA
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //iniciada ya la sesion
        //entra a la pagina del usuario
        switch (Auth::user()->rol){
            case 'tecnico':
                $incidencia = Incidencia::find($id);
                $cliente = Cliente::find($incidencia->cliente_id);
                $vehiculo = Vehiculo::find($incidencia->vehiculo_id);
                $tecnico = Tecnico::where('usuarios_id', Auth::user()->id)->get();
                return view('usuario/tecnico-incidencias-show', ['incidencia' => $incidencia, 'cliente' => $cliente, 'vehiculo' => $vehiculo, 'tecnico' => $tecnico[0]]);
                break;
            default:
                // coger incidencias para mostrar en una paginacion
                $incidencia = Incidencia::find($id);
                $cliente = Cliente::find($incidencia->cliente_id);
                $vehiculo = Vehiculo::find($incidencia->vehiculo_id);
                return view('usuario/resto-incidencia-show', ['incidencia' => $incidencia, 'cliente' => $cliente, 'vehiculo' => $vehiculo]);
        }
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
    public function update( Request $request)
    {
        $incidencia = Incidencia::find(request('id'));
        $tecnico = Tecnico::find($incidencia->tecnico_id);

        //Incidencia ha cambiado de estado a resuelta o resuelta en garaje
        if(request('estado')){
            date_default_timezone_set('Europe/Madrid');
            $date = date('Y-m-d H:i:s');

            $incidencia->estado = request('estado'); //Guarda resuelta o resuelta en garaje
            $incidencia->hora_fin = $date;
            $incidencia->save();

            $tecnico->disponibilidad = 1;
            $tecnico->notificacion_respondida = 0;
            $tecnico->save();
        }
        //Incidencia ha sido rechazada y continua en curso
        else{
            $incidencia->tecnico_id = null;
            $incidencia->save();

            $tecnico->disponibilidad = 1;
            $tecnico->save();
        }
        return redirect()->route('main.index');
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


    public function getIncidenciasTecnicoEstado(Request $request){

        $tecnicoId = Tecnico::where('usuarios_id', Auth::user()->id)->get('id')[0]['id'];
        $findResuelta = ['tecnico_id' => $tecnicoId, 'estado' => 'Resuelta'];
        $findGaraje = ['tecnico_id' => $tecnicoId, 'estado' => 'Garaje'];
        $findEnCurso = ['tecnico_id' => $tecnicoId, 'estado' => 'En curso'];

        $incidenciasEstado = null;

        if(request('estado')){
            session(['estado' => request('estado')]);
        }

        switch (session('estado')){
            case 'resuelta':
                $incidenciasEstado = Incidencia::where($findResuelta)->orderBy('updated_at', 'desc')->paginate(5);
            break;
            case 'taller':
                $incidenciasEstado = Incidencia::where($findGaraje)->orderBy('updated_at', 'desc')->paginate(5);
            break;
            case 'en curso':
                $incidenciasEstado = Incidencia::where($findEnCurso)->orderBy('updated_at', 'desc')->paginate(5);
            break;
        }

        return view('usuario.tecnico-index', ['incidencias' => $incidenciasEstado, 'usuario' => Auth::user(), 'filtro' => session('estado'), 'tecnicoId' => $tecnicoId]);
    }

    public function getIncidenciasTecnicoTipo(Request $request){

        $tecnicoId = Tecnico::where('usuarios_id', Auth::user()->id)->get('id')[0]['id'];

        $findPinchazo = ['tecnico_id' => $tecnicoId, 'tipo' => 'Pinchazo'];
        $findAveria = ['tecnico_id' => $tecnicoId, 'tipo'=> 'Averia'];
        $findGolpe = ['tecnico_id' => $tecnicoId, 'tipo'=> 'Golpe'];
        $findOtro = ['tecnico_id' => $tecnicoId, 'tipo'=> 'Otro'];

        $incidenciasTipo = null;

        if(request('tipo')){
            session(['tipo' => request('tipo')]);
        }

        switch (session('tipo')){
            case 'Pinchazo':
                $incidenciasTipo = DB::table('incidencias')->where($findPinchazo)->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Averia':
                $incidenciasTipo = DB::table('incidencias')->where($findAveria)->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Golpe':
                $incidenciasTipo = DB::table('incidencias')->where($findGolpe)->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Otro':
                $incidenciasTipo = DB::table('incidencias')->where($findOtro)->orderBy('estado', 'asc')->paginate(5);
                break;
        }

        return view('usuario.tecnico-index', ['incidencias' => $incidenciasTipo, 'usuario' => Auth::user(), 'filtro' => session('tipo'), 'tecnico_id' => $tecnicoId]);
    }


    public function getIncidenciasEstado(Request $request){
        $incidenciasEstado = "";

        if(request('estado')){
            session(['estado' => request('estado')]);
        }

        switch (session('estado')){
            case 'resuelta':
                $incidenciasEstado = DB::table('incidencias')->where('estado', 'Resuelta')->orderBy('updated_at', 'desc')->paginate(5);
            break;
            case 'taller':
                $incidenciasEstado = DB::table('incidencias')->where('estado', 'Garaje')->orderBy('updated_at', 'desc')->paginate(5);
            break;
            case 'en curso':
                $incidenciasEstado = DB::table('incidencias')->where('estado', 'En curso')->orderBy('updated_at', 'desc')->paginate(5);
            break;
        }

        return view('usuario.resto-index', ['incidencias' => $incidenciasEstado, 'usuario' => Auth::user(), 'filtro' => session('estado')]);
    }

    public function getIncidenciasTipo(Request $request){
        $incidenciasTipo = "";

        if(request('tipo')){
            session(['tipo' => request('tipo')]);
        }

        switch (session('tipo')){
            case 'Pinchazo':
                $incidenciasTipo = DB::table('incidencias')->where('tipo', 'Pinchazo')->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Averia':
                $incidenciasTipo = DB::table('incidencias')->where('tipo', 'Averia')->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Golpe':
                $incidenciasTipo = DB::table('incidencias')->where('tipo', 'Golpe')->orderBy('estado', 'asc')->paginate(5);
                break;
            case 'Otro':
                $incidenciasTipo = DB::table('incidencias')->where('tipo', 'Otro')->orderBy('estado', 'asc')->paginate(5);
                break;
        }

        return view('usuario.resto-index', ['incidencias' => $incidenciasTipo, 'usuario' => Auth::user(), 'filtro' => session('tipo')]);
    }

}
