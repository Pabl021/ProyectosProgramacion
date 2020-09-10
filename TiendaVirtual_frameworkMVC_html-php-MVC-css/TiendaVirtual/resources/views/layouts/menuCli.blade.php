<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('menuCli.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/cargarProductos.js') }}"></script>
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
                <a href="{{Route('cliente')}}"><h4 style="color: #8a0f01"><b> Cliente: {{ auth()->user()->name }}</b></h4></a>
                </a>               
                <ul class="navbar-nav mr-auto">
                    <form action="{{route('cliente')}}" method="GET">
                        @csrf
                        <select name="select" onchange="this.form.submit()" id="list" style=" background-color:#c4fdf6; font-size: 20px; color: #8a0f01; margin-top: -6px; "  class="form-control">    
                            <option selected="true" disabled="disabled" value="">SELECCIONE UNA CATEGORÍA</option>                    
                                @foreach ($info as $cat)                          
                                    <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                                @endforeach   
                        </select>  
                    </form>                        
                </ul>
                    @guest          
                    @else
                        <a href="{{route('cargarPro')}}"><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal"> 🛒</button></a>                  
                            <form class="form-inline my-2 my-lg-0">                       
                                <div class="dropdown">
                                    <button  style=" background-color:#c4fdf6; font-size: 20px; color: #8a0f01; " class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tus compras
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"style=" background-color:#c4fdf6;" >
                                        <a style=" background-color:#c4fdf6; font-size: 20px; color: #8a0f01; " class="dropdown-item" href="{{route('estadistica')}}">Estadisticas</a>
                                        <a style=" background-color:#c4fdf6; font-size: 20px; color: #8a0f01; " class="dropdown-item" href="{{route('ordenCompra')}}">Compras realizadas</a>                                   
                                    </div>
                                </div>                      
                            </form>                                                   
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