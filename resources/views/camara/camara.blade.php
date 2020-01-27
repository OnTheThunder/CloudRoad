@extends('layouts.layout')
@section('content')

    <div class="main">
        <div class="row sticky-top shadow bg-white">
            @include('usuario.aside')
            <div class="col-md-9 d-flex flex-column">
                <div class="d-flex justify-content-center my-2">
                    <h1>Camaras</h1>
                </div>
                <div class="d-flex flex-row">
                    <div id="imagen" class="col-md-6 col-12 bg-white d-flex justify-content-center">
                        <!-- Aqui se mete la imagen de la camara por JS dependiendo de la seleccionada -->
                    </div>
                    <div id="mapa" class="col-md-6 bg-white d-none d-md-block">
                        <div id="mapa-camaras" class="border img-thumbnail">
                        </div>
                    </div>
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
    <!-- Scripts especificos de la pagina de camaras -->
    <script src="{{secure_asset('js/camaras.js')}}"></script>

@endsection
