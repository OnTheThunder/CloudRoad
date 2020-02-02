<!doctype html>
<html lang="es">
<head>
    {{--Overlay to avoid page loading before css is loaded--}}
    <div id="loadOverlay" style="background-color:#FDFFFB; position:absolute; top:0; left:0; width:100%; height:100%; z-index:2000;"></div>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- BOOTSTRAP CSS-->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" id="light-css" disabled>
    <link href="{{ secure_asset('css/appDarkMode.css') }}" rel="stylesheet" id="dark-css" disabled>
    <!-- CSS asociado a esta vista-->
    <link rel="stylesheet" href="{{secure_asset('css/login.css')}}">
    <!-- Font awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
          integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous"/>
<body class="overflow-hidden">
<script src="{{secure_asset('js/modoNocturnoDiurno.js')}}"></script>
<!-- Contenedor principal -->
@yield('content')
</body>
<!-- jQuery CDN -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<!-- JS personalizados -->
<script src="{{ secure_asset('js/app.js') }}"></script>
<script src="{{ secure_asset('js/login.js') }}"></script>
</html>
