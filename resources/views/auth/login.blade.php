@extends('layouts.layout-login')

@section('content')
<div class="row overflow-hidden" id="login-main-container">
        <div class="col-12 col-md-6 pr-0" id="login-form-container">
            <div id="login-logo" class="col-md-12 d-flex justify-content-center">
                <img class="d-none d-md-block rounded-circle" src="{{ asset('images/onTheThunderNoBorder.png') }}" alt="">
            </div>
            <form method="POST" action="{{ route('login') }}" class="login-form d-flex flex-column justify-content-center align-items-center">
                @csrf
                <h1 id="login-title" class=" col-md-12 mb-5 text-wrap text-center mt-4">WELCOME TO CLOUDROAD</h1>
                <span class="login-input-label">Email</span>
                <input id="email" type="email" class="mb-5 mt-1 form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <span class="login-input-label">Password</span>
                <input id="password" type="password"
                       class="mb-3 form-control @error('password') is-invalid @enderror" name="password" required
                       autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <button class="sign-up-button w-100 my-4 btn">LOG IN</button>
                @if (Route::has('password.request'))
                    <!--<a class="btn btn-link" href="{{ route('password.request') }}">-->
                    <a class="btn btn-link bg-secondary text-light" href="">
                        <i class="fas fa-hammer text-warning"></i>
                        (WIP)  {{ __('No recuerdo mi contraseña') }}
                    </a>
                @endif
            </form>
        </div>
        <div class="d-none d-md-block col-md-6 px-0">
            <div id="login-bg-image">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="slide-wrapper">
                                <img id="laptop" class="d-block w-100" src="{{ asset('images/incidencias.png') }}" alt="First slide">
                                <h2 id="first-quote" class="login-quote">Check the road status</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="slide-wrapper">
                                <img class="d-block w-100" src="{{ asset('images/estadisticas.png') }}" alt="First slide">
                                <h2 id="second-quote" class="login-quote">Analyze real time data</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="slide-wrapper">
                                <img class="d-block w-100" src="{{ asset('images/maps.png') }}" alt="First slide">
                                <h2 id="third-quote" class="login-quote">Google Maps route simulation</h2>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
</div>
<!-- CSS asociado a esta vista-->
<link rel="stylesheet" href="{{secure_asset('css/login.css')}}">
@endsection


