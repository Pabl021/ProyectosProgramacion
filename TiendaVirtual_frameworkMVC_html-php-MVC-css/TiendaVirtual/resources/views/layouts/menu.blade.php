
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/login.css')?>" type="text/css"> 
    
</head>
<body >
    <div id="app" >
        <nav class="navbar navbar-expand-md  shadow-sm" style="background:#9DDFDD" >
            <div class="container" >
                <a class="navbar-brand" href="#">
                    <img src="../imgPro/jp.png" width="60" height="60" alt="">
                    </a>
                <a class="navbar-brand">
                <a href="{{Route('home')}}"><h4 style="color: #8a0f01"><b>Administrador</b></h4></a>
                </a>               
                <ul class="navbar-nav mr-auto">                     
                    <button style=" background-color:#9DDFDD;"> <a style="color: #8a0f01;" href="{{route('categoria')}}">Crear categoría</a></button>
                </ul>
                <ul class="navbar-nav mr-auto">                     
                        <button style=" background-color:#9DDFDD; "><a style="color: #8a0f01;" href="{{route('manipular')}}">Ver/Editar/Eliminar categoría</a></button>                              
                </ul>                 
                <ul class="navbar-nav mr-auto">                     
                    <button style=" background-color:#9DDFDD;"> <a style="color: #8a0f01;" href="{{route('crearPro')}}">Crear producto</a></button>
                </ul>
                <ul class="navbar-nav mr-auto"> 
                <button style=" background-color:#9DDFDD; "><a style="color: #8a0f01;" href="{{route('manipularPro')}}">Ver/Editar/Eliminar producto</a></button>                              
                </ul> 
                    @guest                               
                        @else                                                   
                            <h4><b> <a style="color: #8a0f01"  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a></b></h4>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>                                                         
                    @endguest                                
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
