<nav class="navbar navbar-light bg-primary ">

    <div class="navbar col d-flex justify-content-center" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-navbar" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Cambiar contraseña</a>
            <a class="dropdown-item" href="#">Cerrar sesión</a>
        </div>
    </div>
</nav>



