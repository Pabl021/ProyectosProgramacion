@extends('layouts.menuCli')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/login.css')?>" type="text/css">
    <title>Cliente</title>
</head>
<body>
  
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-5">
          <h1 class="text-center"><b>JP SPORT</b></h1>
          <h3 class="text-center">Tu tienda de confianza ✔️</h3>                        
          <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2" action="{{route('ordenCompra')}}" method="GET">
            @csrf
            <label for=""><h4>Selecciona la fecha de compra del producto: </h4>
            <input type="date" name="fecha" placeholder="Año/Mes/Día" > <button>🔎</button> </label>
            <i class="fas fa-search" aria-hidden="true"></i>
          </form>
          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">PRECIO</th>
                <th scope="col">FECHA</th>
                                     
              </tr>
            </thead>
            <tbody>
              @foreach ($producto as $cat)       
                <tr>
                  <th scope="row">{{$cat->nombre}}</th>
                  <th scope="row">{{$cat->monto}}</th>
                  <th scope="row">{{$cat->fecha}}</th>
                </tr>                             
              @endforeach
                <tr>
                  <th scope="row">{{'Total pagado: '.$total}}</th>                               
                </tr>
            </tbody>
          </table>                
        </div>
      </div>
    </div>
  </div>      
</body>
</html>
@endsection