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
            <div class="row border">
                <form class="col-12" method="post" action="{{route('usuario.update')}}">
                    @csrf

                    <div id="buscador" class="col-12 border">
                        <p class="h1">Buscador</p>

                    </div>


                    <div id="div-extra"></div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary justify-content-center">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
