<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400&display=swap" rel="stylesheet">
    <!-- BOOTSTRAP CSS-->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
          integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous"/>
    <!-- CSS personalizados -->
    <link href="{{ secure_asset('css/main.css') }}" rel="stylesheet">
</head>
<body>


<!-- Header/navbar -->
@include('layouts.navbar')
<!-- Contenedor principal -->
<div class="container-fluid">
    @yield('content')
</div>

<!-- Footer -->
{{--@include('layouts.footer')--}}

</body>
<!--GOOGLE MAPS-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtvT3u8mJZLBOy9ZZG7kQ-t9hE0X8ycs4&&libraries=places" async defer></script>
<!-- jQuery CDN -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<!-- JS personalizados -->
<script src="{{ secure_asset('js/app.js') }}"></script>
<script src="{{ asset('js/dropdown-filtros.js') }}"></script>
</html>
