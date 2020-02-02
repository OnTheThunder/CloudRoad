@extends('layouts.layout')
@section('content')
    <div class="main">
        <div class="row sticky-top shadow bg-color-body pb-5">
            <div class="col-12 col-lg-3 d-none d-sm-block">
            @include('usuario.aside_movil')
            </div>
            <div class="col-lg-9 d-flex flex-column media-container">
                <div class="d-flex justify-content-center mb-3 page-title d-sm-none">
                    <h1>Camaras</h1>
                </div>
                <div class="d-flex flex-row img-thumbnail">
                    <div id="imagen" class="col-md-6 col-12  d-flex justify-content-center">
                        <!-- Aqui se mete la imagen de la camara por JS dependiendo de la seleccionada -->
                    </div>
                    <div id="mapa" class="col-md-6 d-none d-md-block">
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
