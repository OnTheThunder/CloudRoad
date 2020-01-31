@extends('layouts/layout')
@section('content')

    <div class="row">
        @if(app('request')->input('resultado') == "0")
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    El email ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if(app('request')->input('resultado') == "1")
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Usuario agregado correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @include('usuario.aside')
        <div class="col col-lg-8 d-flex flex-column mr-2 ">
            <div class="h1 my-4 text-center">Baja usuario</div>
            <div class="container">
                <form class="col-12" method="get" action="{{route('usuario.baja.edit')}}">
                    @csrf
                    <div id="buscador" class="row">
                        <div class="col-6">
                            <div class="row form-group p-3">
                                <label for="nombre">Nombre</label>
                                <input class="form-control" name="nombre" id="nombre">
                            </div>
                            <div class="row form-group p-3">
                                <label for="email">E-mail</label>
                                <input class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row p-3">
                                <label for="rol">Rol</label>
                                <input class="form-control" name="rol" id="rol">
                            </div>
                            <div class="form-group row p-3 ">
                                <label class="col-12">Activado</label>
                                <input type="radio" class=" mr-2 ml-2 mt-1" name="activo" value="2" id="Ambos" checked><label for="Ambos">Ambos</label>
                                <input type="radio" class=" mr-2 ml-4 mt-1" name="activo" value="1" id="Activo"><label for="Activo">Activo</label>
                                <input type="radio" class=" mr-2 ml-4 mt-1" name="activo" value="0" id="NoActivo"><label for="NoActivo">No activo</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end col-12">
                            <button class="btn btn-primary col-md-2" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

                <div class="row justify-content-center m-2 mt-5">
                    <table class="table table-bordered table-striped table-hover table-datos overflow-auto">
                        <thead class="bg-color-cards">
                        <tr>
                            <th>@sortablelink('nombre', 'Nombre')</th>
                            <th>@sortablelink('email','E-Mail')</th>
                            <th>@sortablelink('rol', 'Rol')</th>
                            <th>Alta</th>
                            <th>Baja</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->email}}</td>
                                <td class="text-capitalize">{{$usuario->rol}}</td>
                                <td>
                                    @if($usuario->activo == 0)

                                        <button type="button" id="activar" value="{{$usuario->id}}"
                                                class="btn btn-outline-success activar" onclick="altaBaja('activar',{{$usuario->id}})">
                                            Activar
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($usuario->activo == 1)
                                        <button type="button" id="desactivar" value="{{$usuario->id}}"
                                                class="btn btn-outline-danger desactivar" onclick="altaBaja('desactivar',{{$usuario->id}})">
                                            Desactivar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mb-5 mt-3 paginacion">
                        {!! $usuarios->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{secure_asset('js/altabajaUsuario.js')}}"></script>
@endsection
