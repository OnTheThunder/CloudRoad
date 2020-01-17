@if($user == 1)
    <div class="d-flex flex-column">
        <button type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</button>

        <div class="list-group">

            <a href="#" class="list-group-item list-group-item-action "> <i class="fas fa-user-plus"></i>{{Auth::user()}} Nuevo usuario</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-chart-bar"></i> Estadisticas</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Datos</a>
        </div>
    </div>
@elseif($user == 2)
    <div class="d-flex flex-column">
        <a type="button" class="btn btn-primary my-5"><i class="fas fa-video" ></i> Camaras</a>
    </div>
@endif
