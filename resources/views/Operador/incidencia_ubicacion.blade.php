@extends('layouts.layout')

@section('content')
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
            <div>
                {{--<h3>{{ $taller->Nombre }}</h3>
                <p>{{ $taller->Provincia }}</p>--}}
            </div>
           <div>
               <table class="table table-striped">
                   <thead>
                       <tr>
                           <th scope="col">Nombre</th>
                           <th scope="col">Apellidos</th>
                           <th scope="col">Teléfono</th>
                           <th scope="col">Email</th>
                           <th scope="col">Acciones</th>
                       </tr>
                   </thead>
                   <tbody>
                   {{--@foreach($tecnicos as $tecnico)
                       @if($taller->id == $tecnico->taller_id)
                       <tr>
                           <td>{{ $tecnico->nombre }}</td>
                           <td>{{ $tecnico->apellidos }}</td>
                           <td>{{ $tecnico->telefono }}</td>
                           <td>@{{ $tecnico->email }}</td>
                           <td><a href="{{ route('incidencia.index') }}" class="btn btn-outline-primary">Seleccionar</a></td>
                       </tr>
                   @endforeach--}}
                   </tbody>
               </table>
           </div>
        </div>
    </div>
    <script src="{{ asset('js/mapaOperador.js') }}"></script>
@endsection
