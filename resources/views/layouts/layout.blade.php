<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <!-- BOOTSTRAP -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
          integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous"/>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
<!-- Header/navbar -->
@include('layouts.navbar')
<!-- Contenedor principal -->
    <div class="row">
        <div class="col-3">
            @include('layouts.aside')
        </div>
        @yield('content')
    </div>



<!-- Footer -->
@include('layouts.footer')
</div>

</body>
<!-- jQuery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!-- BOOTSTRAP JS -->
<!-- DESCOMENTAR SI FALLA EL HTTPS <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ secure_asset('js/app.js') }}"></script>
</html>
