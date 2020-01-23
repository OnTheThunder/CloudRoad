<?php

namespace App\Http\Controllers;

use App\Charts\Estadistica;
use App\Coordinador;
use App\incidencia;
use App\Tecnico;
use App\Cliente;
use App\Taller;
use App\Operario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class CoordinadorController extends Controller
{

    public function getCoor(int $id, string $rol)
    {
        $coor = new Coordinador;
        $users = DB::table('coordinadores')
            ->select('*')
            ->where('')
            ->get();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinador $coordinador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinador $coordinador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinador $coordinador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinador $coordinador)
    {
        //
    }

    public function datos(Request $request){
        $tipoDato = request('tipoDato');
        if(isset($tipoDato)){
            $datosVista = [];
            switch ($tipoDato){
                case "Clientes": $datosVista = Cliente::all();
                break;
                case "Tecnicos": $datosVista = Tecnico::all();
                break;
                case "Talleres": $datosVista = Taller::all();
                break;
                case "Operadores": $datosVista = Operario::all();
                break;
                case "Coordinadores": $datosVista = Coordinador::where('isJefe', '0')->get();
                break;
                case "Jefes": $datosVista = Coordinador::where('isJefe', '1')->get();
                break;
            }
            return $datosVista;
        }
        return view('datos', ['usuario' => Auth::user()]);
    }

    public function estadisticas(Coordinador $coordinador)
    {
        return view('estadisticas/estadisticas', ['usuario' => Auth::user()]);
    }

    public function cargarGrafico(Request $request, Coordinador $coordinador)
    {

        $grafico = request()->all()['elegido'];
        $array = array();
            switch ($grafico){
                case 'Incidencias por hora':
                    $array = CoordinadorController::porHora();
                    break;
                case 'Incidencias de cada tecnico':
                    $array = CoordinadorController::porTecnico();
                    break;
                case 'Incidencias por provincia':
                    $array = CoordinadorController::porProvincia();
                    break;
                case 'Estado de incidencia':
                    $array = CoordinadorController::porEstado();
                    break;
                case 'Tipo de avería':
                    $array = CoordinadorController::porTipo();
                    break;
            }
            return $array;
    }

    public function porHora() {
        //Creamos array con 24 arrays dentro uno para cada hora
        $horas = array();

        for($x = 0; $x < 3; $x++){
            $array = array();
            array_push($horas, $array);
            for($i = 0; $i < 24; $i++){
                array_push($horas[$x], $array);
            }
        }

        //Sacamos la hora de todas las incidencias de la base de datos
        $incidencias_hora = Incidencia::all('hora_fin');
        $incidencias_hora_ultimo_mes = DB::table('incidencias')->where('created_at', '>=', DB::raw('date_sub(curdate(), interval 1 month)'))->get('hora_fin');
        $incidencias_hora_ultima_semana = DB::table('incidencias')->where('created_at', '>=', DB::raw('date_sub(curdate(), interval 1 week)'))->get('hora_fin');

        //Llenamos el los arrays de cada hora con la incidencias que le correspondan
        foreach ($incidencias_hora as $incidencia_hora) {
            $hora = substr($incidencia_hora->hora_fin, 0, 2);
            array_push($horas[0][intval($hora)], $hora);
        }
        foreach ($incidencias_hora_ultimo_mes as $incidencia_hora) {
            $hora = substr($incidencia_hora->hora_fin, 0, 2);
            array_push($horas[1][intval($hora)], $hora);
        }
        foreach ($incidencias_hora_ultima_semana as $incidencia_hora) {
            $hora = substr($incidencia_hora->hora_fin, 0, 2);
            array_push($horas[2][intval($hora)], $hora);
        }

        return $horas;
    }

    public function porTecnico() {
        $tecnicos = array();

        for($x = 0; $x < 10; $x++){
            $array = array();
            array_push($tecnicos, $array);
        }

        //Sacamos la hora de todas las incidencias de la base de datos
        $incidencias_tecnico = DB::table('incidencias')->groupBy('tecnico_id')->orderBy('incidencias', 'desc')->get(DB::raw('count(tecnico_id) as incidencias, tecnico_id'))->take(10);

        //Llenamos el los arrays de cada hora con la incidencias que le correspondan
        $contador = 0;
        foreach ($incidencias_tecnico as $incidencia_tecnico) {
            array_push($tecnicos[$contador], $incidencia_tecnico->incidencias);
            $nombre_tecnicos = DB::table('tecnicos')->where('id', '=', $incidencia_tecnico->tecnico_id)->get('nombre');
            //return $nombre_tecnicos;
            array_push($tecnicos[$contador], $nombre_tecnicos[0]->nombre);
            $contador ++;
        }

        return $tecnicos;
    }

    public function porProvincia() {
        $provincias = array();

        for($x = 0; $x < 4; $x++){
            $array = array();
            array_push($provincias, $array);
        }

        $incidencias_provincia = Incidencia::all('provincia');

        foreach ($incidencias_provincia as $incidencia_provincia ) {
            $provincia = $incidencia_provincia->provincia;
            switch($provincia){
                case 'Alava':
                    array_push($provincias[0], $provincia);
                    break;
                case 'Guipuzcoa':
                    array_push($provincias[1], $provincia);
                    break;
                case 'Vizcaya':
                    array_push($provincias[2], $provincia);
                    break;
                case 'Navarra':
                    array_push($provincias[3], $provincia);
                    break;
            }

        }
        return $provincias;
    }

    public function porEstado() {
        $estados = array();

        for($x = 0; $x < 3; $x++){
            $array = array();
            array_push($estados, $array);
            for($i = 0; $i < 2; $i++){
                array_push($estados[$x], $array);
            }
        }

        $incidencias_estado = Incidencia::all('estado');
        $incidencias_estado_ultimo_mes = DB::table('incidencias')->where('created_at', '>=', DB::raw('date_sub(curdate(), interval 1 month)'))->get('estado');
        $incidencias_estado_ultima_semana = DB::table('incidencias')->where('created_at', '>=', DB::raw('date_sub(curdate(), interval 1 week)'))->get('estado');

        foreach ($incidencias_estado as $incidencia_estado ) {
            $estado = $incidencia_estado->estado;
            switch($estado){
                case 0:
                    array_push($estados[0][0], $estado);
                    break;
                case 1:
                    array_push($estados[0][1], $estado);
                    break;
            }

        }
        foreach ($incidencias_estado_ultimo_mes as $incidencia_estado ) {
            $estado = $incidencia_estado->estado;
            switch($estado){
                case 0:
                    array_push($estados[1][0], $estado);
                    break;
                case 1:
                    array_push($estados[1][1], $estado);
                    break;
            }

        }
        foreach ($incidencias_estado_ultima_semana as $incidencia_estado ) {
            $estado = $incidencia_estado->estado;
            switch($estado){
                case 0:
                    array_push($estados[2][0], $estado);
                    break;
                case 1:
                    array_push($estados[2][1], $estado);
                    break;
            }

        }
        return $estados;
    }

    public function porTipo() {
        $tipos = array();

        for($x = 0; $x < 4; $x++){
            $array = array();
            array_push($tipos, $array);
        }

        $incidencias_tipo = Incidencia::all('tipo');

        foreach ($incidencias_tipo as $incidencia_tipo ) {
            $tipo = $incidencia_tipo->tipo;
            switch($tipo){
                case 'Golpe':
                    array_push($tipos[0], $tipo);
                    break;
                case 'Pinchazo':
                    array_push($tipos[1], $tipo);
                    break;
                case 'Averia':
                    array_push($tipos[2], $tipo);
                    break;
                case 'Otro':
                    array_push($tipos[3], $tipo);
                    break;
            }
        }
        return $tipos;
    }
}
