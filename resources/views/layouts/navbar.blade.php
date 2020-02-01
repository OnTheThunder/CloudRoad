<nav class="navbar navbar-light bg-color-header shadow-sm mb-2">

    <div class="navbar col d-flex justify-content-start " id="navbarTogglerDemo01">
        <a class="navbar-brand" href="{{route('main.index')}}">{{ config('app.name') }}</a>
    </div>

    <!-- si esta logeado o no  vea unas opciones u otras-->
    @if(Auth::user() == null)
        <ul class="navbar-nav flex-row">
            <!-- Authentication Links -->
            @guest
                {{--                <li class="nav-item mr-5">--}}
                {{--                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }} </a>--}}
                {{--                </li>--}}
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
            <button class="border-0 bg-color-header dropdown-toggle rounded" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <span class="text-capitalize">
                    <strong class="font-weight-bolder">{{Auth::user()->rol}}</strong>
                    <span class="text-color-user">{{ Auth::user()->nombre }}</span>
                </span>
                <i class="fas fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left dropdown-menu-sm-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="" id="modo-nocturno-diurno">{{__('general.modo')}}</a>

                <a class="dropdown-item"
                   href="{{ route('usuario.password.edit',['modo'=>'password']) }}">{{__('general.change.password')}}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">{{ __('auth.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endif
            <small>{{Config::get('app.locale')}}</small>
        </div>
</nav>
<!-- el script que le pone el listener del modo nocturno y diurno-->
<script src="{{secure_asset('js/modoNocturnoDiurno.js')}}"></script>
