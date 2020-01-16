<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CloudRoad</title>
    <!-- BOOTSTRAP -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
          integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous"/>
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
@include('layouts.footer')

</body>
<!-- jQuery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<!-- BOOTSTRAP JS -->
<script src="{{ secure_asset('js/app.js') }}"></script>
</html>
