<?php

namespace App\Http\Controllers;

use App\Charts\prueba;
use App\Coordinador;
use App\incidencia;
use App\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function datos(Coordinador $coordinador){
        return view('datos');
    }

    public function estadisticas(Coordinador $coordinador){
        $horas = array
        (
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array(),
            array()
        );

        $incidencias_hora = Incidencia::all('hora_fin');

        foreach($incidencias_hora as $incidencia_hora){
            $hora = substr($incidencia_hora->hora_fin, 0, 2);
            array_push($horas[intval($hora)], $hora);
        }

        $chart = new prueba;
        $chart->labels(['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23']);
        /*$chart->dataset('Incidencas por hora en Alava', 'bar', )*/
        $chart->dataset('Incidencias por hora', 'bar', [count($horas[0]), count($horas[1]), count($horas[2]), count($horas[3]), count($horas[4]),
        count($horas[5]), count($horas[6]), count($horas[7]), count($horas[8]), count($horas[9]), count($horas[10]), count($horas[11]), count($horas[12]), count($horas[13]),
        count($horas[14]), count($horas[15]), count($horas[16]), count($horas[17]), count($horas[18]), count($horas[19]), count($horas[20]), count($horas[21]), count($horas[22]),
        count($horas[23])]);

        return view('coordinador/estadisticas', ['chart' => $chart]);
    }
}
