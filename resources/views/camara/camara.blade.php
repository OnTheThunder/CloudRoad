@extends('layouts.layout')
@section('content')
    <script src="{{asset('js/Camara.js')}}"></script>
    <script src="{{asset('js/camaras.js')}}"></script>
    <h1>Cámaras</h1>
    Jefe, coordinador y operador ven las camaras

    <div class="main">

        <div class="row border sticky-top">
            <div id="imagen" class="col-6 bg-white">
                <!-- Aqui se mete la imagen de la camara por JS dependiendo de la seleccionada -->
            </div>

            <div id="mapa" class="col-6 bg-white">
                <div id="mapa-camaras">
                </div>
            </div>
        </div>

        <div class="row">
            <div id="buscador" class="w-100">
                <table id="tabla-lugares" class="table table-bordered table-hover data-table-container">
                    <thead class="thead-dark ">
                    <th>Lugar</th>
                    <th>Carretera</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
