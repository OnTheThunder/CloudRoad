<?php

namespace App\Http\Controllers;

use App\Operario;
use Illuminate\Http\Request;

class MainController extends Controller
{
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
