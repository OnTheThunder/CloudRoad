<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
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
        $vehiculos = Vehiculo::all();
        return view('vehiculo-pruebas', ['vehiculos' => $vehiculos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehiculo = new Vehiculo;
        $vehiculo->matricula = $request->matricula;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->marca = $request->marca;
        $vehiculo->aseguradora = $request->aseguradora;
        $vehiculo->cliente_id = $request->cliente_id;
        $vehiculo->save();

        return redirect()->route('vehiculo.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vehiculo $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
