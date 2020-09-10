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
  

  
  @foreach ($producto as $pro)      
    <div class="card text-white bg-dark mb-3" style="width: 18rem;" >           
      <img  class=" img card-img-top" src="{{asset('/storage/'.$pro->imagen)}}" style=" width: 100px; height: 100px; align:center;" >       
      <div class="card-body">
        <h5  class="card-title" style="text-align: center">{{$pro->nombre}}</h5>
        <p class="card-text" style="text-align: center">{{$pro->descripcion}}</p>
        <h5 class="card-title" style="text-align: center">{{$pro->precio}}</h5>
        <h5 style="display: none"> {{$pro->id}} </h5>
        <a href="{{route('cargarId',$pro->id)}}" class="btn btn-primary">Agregar al 🛒</a>
      </div>
    </div>
  @endforeach 
    
        
</body>
</html>
@endsection
