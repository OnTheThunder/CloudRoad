@extends('layouts.layout')
@section('content')
    <script src="{{asset('js/Camara.js')}}"></script>
    <script src="{{asset('js/camaras.js')}}"></script>
    <h1>Cámaras</h1>

    <div class="main">
        <select id="lugares" name="lugar" class="col">
            <option value="0">-- Selecciona una opcion</option>
        </select>

        <div id="mapa">

        </div>
    </div>


@endsection
