@section('content')
    <div class="row">
        <div class="col-3">
            <!-- Aside de cosas que puede hacer -->
            <div class="d-flex flex-column p-2 border h-100">
                <a type="button" class="btn btn-primary mb-2" href="{{route('camaras.show')}}">
                    <i class="fas fa-video mr-2"></i>Camaras de tráfico
                </a>
                <div class="list-group">
                    <!-- If de crear usuario -->
                    @if($usuario->rol == 'jefe' || $usuario->rol == 'coordinador')
                        <a href="#" class="list-group-item list-group-item-action bg-color-anyadir-suave">
                            <i class="fas fa-user-plus mr-2"></i>Nuevo usuario</a>
                        <a href="#" class="list-group-item list-group-item-action bg-color-borrar-suave">
                            <i class="fas fa-user-minus mr-2"></i>Dar de baja usuario</a>
                    @endif
                    <a href="{{ route('coordinador.estadisticas') }}"
                       class="list-group-item list-group-item-action bg-color-estadisticas-suave">
                        <i class="fas fa-chart-bar mr-2"></i>Estadisticas</a>
                    <a href="{{ route('coordinador.datos') }}"
                       class="list-group-item list-group-item-action bg-color-datos-suave">
                        <i class="fas fa-users mr-2"></i>Datos</a>
                </div>
            </div>
        </div>

        <!-- Main container de ver historial y filtrar -->
        <div class="col d-flex flex-column mr-2 p-2 border">
            <div class="d-flex justify-content-center">
                <a href="{{ route('incidencia.create') }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-plus mr-2"></i>Crear Incidencia
                </a>
            </div>

            <div class="d-flex">
                <h2>Historial</h2>
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-primary btn-lg" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Tipo</a>
                        <a class="dropdown-item" href="#">Estado</a>
                    </div>
                </div>

            </div>
            <div>
                @foreach($incidencias as $incidencia)
                    <div>
                        <h3>{{ $incidencia->tipo }}</h3>
                        <p>{{ $incidencia->descripcion }}</p>
                        @if($incidencia->estado)
                            <p>Resuelta</p>
                        @else
                            <p>En proceso</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
