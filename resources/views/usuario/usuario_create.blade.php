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
    <!-- TODO cuando se cree el usuario, se envie un email diciendole que contraseña tiene(la por defecto 12345678) -->
        <div class="col d-flex flex-column mr-2 ">
            <div class="h1 text-center">Nuevo usuario</div>
            <div class="row justify-content-center">
                <form class="col" method="post" action="{{route('usuario.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName">Nombre</label>
                        <input name="nombre" type="text" class="form-control" id="exampleInputName"
                               placeholder="Inserta nombre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputApellido">Apellido</label>
                        <input name="apellidos" type="text" class="form-control" id="exampleInputApellido"
                               placeholder="Inserta apellidos">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTelefono">Teléfono</label>
                        <input name="telefono" type="number" class="form-control" id="exampleInputTelefono"
                               placeholder="Inserta número de teléfono">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDni">DNI</label>
                        <input name="dni" type="number" class="form-control" id="exampleInputDni"
                               placeholder="Inserta DNI">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo electrónico</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp"
                               placeholder="Inserta el correo electrónico">
                        <small id="emailHelp" class="form-text text-muted">Garantizamos la seguridad de que nadie podra
                            ver este email.</small>
                    </div>
                    <div class="form-group">
                        <label for="rolSelect">Selecciona su rol</label>
                        <select name="rol" class="form-control" id="rolSelect">
                            @if($usuario->rol == 'jefe')
                                <option value="jefe">Jefe</option>
                                <option value="coordinador">Coordinador</option>
                            @endif
                            <option value="tecnico">Técnico</option>
                            <option value="operario">Operario</option>
                        </select>
                    </div>
                    <div id="div-extra"></div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary justify-content-center">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/registrarUsuario.js') }}"></script>
@endsection
