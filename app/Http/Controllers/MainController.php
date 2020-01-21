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

    public function getUsuarioTipo(Request $request, int $id, string $rol)
    {
        switch ($rol) {
            case 'jefe':
                $user = DB::table('coordinadores')
                    ->select('*')
                    ->where('usuarios_id','=', $id)
                    ->get();
                $request->session(['usuario' => 'verde']);
                //Session::setId('usuario',$user);
                Auth::user()->apellidos = "apellllllll";
                return $user;
                break;
            case 'coordinador':
                break;
            case 'coordinador':
                break;
            case 'coordinador':
                break;
        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('user');

        //ver si se inició sesion
        if ($value != null) {
            //entra a la pagina del usuario
            return view('coordinador.coordinador', ['value' => $value]);
        } else {
            //pasar el login
            return view('coordinador.coordinador', ['value' => $value]);
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
}
