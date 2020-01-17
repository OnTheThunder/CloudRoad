@extends('layouts.layout')

@section('content')
        <div class="col-3"></div>
        <div class="col-6">
            <div class="d-flex justify-content-center my-4">
                <h2>Seleccionar ubicación</h2>
            </div>
            <div>
                <!--Mapa-->
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
@endsection
