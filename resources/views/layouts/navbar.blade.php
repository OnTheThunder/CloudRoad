<nav class="row navbar navbar-light bg-primary ">

    <div class="navbar col d-flex justify-content-center " id="navbarTogglerDemo01">
        <a class="navbar-brand" href="{{route('main.index')}}">{{ config('app.name') }}</a>
    </div>

    <!-- si esta logeado o no  vea unas opciones u otras-->
    @if(Auth::user() == null)
        <ul class="navbar-nav ">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <!-- ver el dropdown de cambiar contraseña y cerrar sesion -->
    @else
        <div class="dropdown">
            <button class="border-0 bg-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <span>Bienvenido, {{ Auth::user()->nombre }} </span>
                <i class="fas fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-navbar" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Cambiar contraseña</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endif
        </div>
</nav>



