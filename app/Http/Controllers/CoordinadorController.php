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
        return view('datos');
    }

    public function estadisticas(Coordinador $coordinador)
    {
        return view('estadisticas/estadisticas');
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
                    $chart = CoordinadorController::porTipo();
                    break;
            }

            return $array;

    }

    public function porHora() {
        //Creamos array con 24 arrays dentro uno para cada hora
        $horas = array();

        for($x = 0; $x < 24; $x++){
            $array = array();
            array_push($horas, $array);
        }

        //Sacamos la hora de todas las incidencias de la base de datos
        $incidencias_hora = Incidencia::all('hora_fin');

        //Llenamos el los arrays de cada hora con la incidencias que le correspondan
        foreach ($incidencias_hora as $incidencia_hora) {
            $hora = substr($incidencia_hora->hora_fin, 0, 2);
            array_push($horas[intval($hora)], $hora);
        }

        return $horas;
    }

    public function porTecnico() {

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

        for($x = 0; $x < 2; $x++){
            $array = array();
            array_push($estados, $array);
        }

        $incidencias_estado = Incidencia::all('estado');

        foreach ($incidencias_estado as $incidencia_estado ) {
            $estado = $incidencia_estado->estado;
            switch($estado){
                case 0:
                    array_push($estados[0], $estado);
                    break;
                case 1:
                    array_push($estados[1], $estado);
                    break;
            }

        }
        return $estados;
    }

    public function porTipo() {

    }
}
