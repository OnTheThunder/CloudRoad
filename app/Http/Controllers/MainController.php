<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\incidencia;
use App\Operario;
use App\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function getUsuarioTipo(int $id, string $rol)
    {
        switch ($rol) {
            case 'jefe':
                $userJ = DB::table('coordinadores')
                    ->select('*')
                    ->where('usuarios_id', '=', $id)
                    ->get();
                return $userJ;
            case 'coordinador':
                $userC = DB::table('coordinadores')
                    ->select('*')
                    ->where('usuarios_id', '=', $id)
                    ->get();
                return $userC;
            case 'tecnico':
                $userT = DB::table('tecnicos')
                    ->select('*')
                    ->where('usuarios_id', '=', $id)
                    ->get();
                return $userT;
            case 'operador':
                $userO = DB::table('operarios')
                    ->select('*')
                    ->where('usuarios_id', '=', $id)
                    ->get();
                return $userO;
        }
        return 'error';
    }

    /**
     *  Display view camras.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCamaras()
    {
        return view('camara.camara', ['usuario' => Auth::user()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //iniciada ya la sesion
        //entra a la pagina del usuario
        switch (Auth::user()->rol){
            case 'tecnico':
                $tecnico = Tecnico::where('usuarios_id', Auth::user()->id)->get()[0];
                $notificacion = false;

                //Si el tecnico no esta disponible (se le ha asignado una incidencia) y no notificacion_respondida es false, le mostramos notificacion y botones aceptar rechazar
                if($tecnico['disponibilidad'] == 0 AND $tecnico['notificacion_respondida'] == 0){
                    $notificacion = true;
                }

                //Order by dependiendo de lo seleccionado por el tecnico
                if(request('orden')){ //check orden solicitado
                    $incidencias = MainController::getIncidenciasTecnicoOrderBy(request('orden'), $tecnico);
                }
                else{ //default mas recientes
                    $incidencias = Incidencia::where('tecnico_id', $tecnico['id'])->orderBy('created_at', 'desc')->paginate(15);
                }

                return view('usuario/tecnico-index', ['incidencias' => $incidencias, 'usuario' => Auth::user(), "notificacion" => $notificacion, 'tecnicoId' => $tecnico['id']]);
            break;
            default:
                //Order by dependiendo de lo seleccionado por el usuario
                if(request('orden')){ //check orden solicitado
                    $incidencias = MainController::getIncidenciasAllOrderBy(request('orden'));
                }
                else{ //default mas recientes
                    $incidencias = DB::table('incidencias')->orderBy('created_at', 'desc')->paginate(15);
                }

                return view('usuario.resto-index', ['incidencias' => $incidencias, 'usuario' => Auth::user()]);
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Operario $operario
     * @return \Illuminate\Http\Response
     */
    public function show(Operario $operario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Operario $operario
     * @return \Illuminate\Http\Response
     */
    public function edit(Operario $operario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Operario $operario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operario $operario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Operario $operario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operario $operario)
    {
        //
    }

    public function getIncidenciasTecnicoOrderBy($orden, $tecnico){
        session(['orden' => $orden]);
        $incidencias = null;

        if(session('orden') === 'reciente'){
            $incidencias = Incidencia::where('tecnico_id', $tecnico['id'])->orderBy('created_at', 'desc')->paginate(15);
        }
        elseif (session('orden') === 'antigua'){
            $incidencias = Incidencia::where('tecnico_id', $tecnico['id'])->orderBy('created_at', 'asc')->paginate(15);
        }

        return $incidencias;
    }

    public function getIncidenciasAllOrderBy($orden){
        session(['orden' => $orden]);
        $incidencias = null;

        if(session('orden') === 'reciente'){
            $incidencias = DB::table('incidencias')->orderBy('created_at', 'desc')->paginate(15);
        }
        elseif (session('orden') === 'antigua'){
            $incidencias = DB::table('incidencias')->orderBy('created_at', 'asc')->paginate(15);
        }

        return $incidencias;
    }
}
