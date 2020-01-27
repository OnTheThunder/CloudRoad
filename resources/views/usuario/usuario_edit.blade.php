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
        <div class="col d-flex flex-column mr-2 ">
            <div class="h1 text-center">Baja usuario</div>
            <div class="row">
                <form class="col-12" method="post" action="">
                    @csrf

                    <div id="buscador" class="row">
                        <p class="h1 col-12">Buscador</p>
<!-- CAMBIAR A QUE SEA col-6 para ocupar menos-->
                        <div class="form-group col-12">
                            <label>Nombre</label>
                            <input class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label>E-mail</label>
                            <input class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label>Rol</label>
                            <input class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label>Activado</label>
                            <input type="checkbox" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center col-12">
                            <button class="btn btn-primary">Buscar TODO</button>
                        </div>
                    </div>

                    <div class="row justify-content-center m-2 mt-5">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="bg-color-datos-suave">
                            <tr>
                                <th>@sortablelink('nombre', 'Nombre', ['rel' => 'nofollow'])</th>
                                <th>@sortablelink('email','E-Mail')</th>
                                <th>@sortablelink('rol', 'Rol')</th>
                                <th>Baja</th>
                                <th>Alta</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{$usuario->nombre}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td class="text-capitalize">{{$usuario->rol}}</td>
                                    <td>
                                        @if($usuario->activo == 1)

                                            <button class="btn btn-outline-success">Activar</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($usuario->activo == 0)
                                            <button class="btn btn-outline-danger">Desactivar</button>
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
                </form>
            </div>
        </div>
    </div>

@endsection
