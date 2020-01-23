@extends('layouts.layout')
@section('content')
    <!-- Scripts especificos de la pagina de camaras -->
    <script src="{{asset('js/camaras.js')}}"></script>

    <div class="main ">
        <div class="row sticky-top shadow bg-white">
            <h1 class="col-12 text-center">Cámaras</h1>
            <div id="imagen" class="col-6 bg-white d-flex justify-content-center">
                <!-- Aqui se mete la imagen de la camara por JS dependiendo de la seleccionada -->
            </div>
            <div id="mapa" class="col-6 bg-white">
                <div id="mapa-camaras" class="border img-thumbnail">
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
