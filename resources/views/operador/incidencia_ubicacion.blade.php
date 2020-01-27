@extends('layouts.layout')

@section('content')
    <div class="fadeOut-wrapper">
        <div class="row">
            <div class="col-md-12 pl-0 pr-0">
                <div id="map-container">
                    <div id="map-search-container">
                        <input class="form-control" type="text" id="mapsearch" placeholder="Realiza tu búsqueda">
                    </div>
                    <div id="map-legend-container">
                        <div id="map-legend">
                            <span>Selecciona la ubicación del incidente</span>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
                <div id="tecnico-fullscreen-data">
                    <div id="tecnico-data-container">
                        <div id="table-header-container">
                            <h2 id="table-header">Notifica a un técnico</h2>
                            <i class="fas fa-info-circle" id="lista-tecnicos-info" data-toggle="tooltip" data-placement="right" title="Técnicos del taller más cercano, dentro de su jornada laboral y disponibles para atender incidencias."></i>
                        </div>
                        <table id="tabla-tecnicos-disponibles" class="table table-bordered">
                           <thead>
                               <tr>
                                   <th>Nombre</th>
                                   <th>Apellidos</th>
                                   <th>Teléfono</th>
                                   <th>Email</th>
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                           <!-- Lo llenamos con JS -->
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/mapaOperador.js') }}"></script>
@endsection
