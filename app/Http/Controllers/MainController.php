<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\Operario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('camara.camara');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //entra a la pagina del usuario
        return redirect()->route('incidencia.index');
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
}
