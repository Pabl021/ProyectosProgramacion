@extends('layouts.menu')
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
    <title>Manipular producto</title>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $("#content").fadeOut(1500);
            },2000);     
        });
      </script>  

</head>
<body>
    
    
@section('content')

@if (@empty(session('guardado')))
@else
  <div class="alert alert-success" id="content">
    <strong>{{session('guardado')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
  
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">NOMBRE</th>
        <th scope="col">DESCRIPCIÓN</th>
   {{-- <th scope="col">IMAGEN</th> --}}
        <th scope="col">CÓDIGO_CAT</th>
        <th scope="col">STOCK</th>
        <th scope="col">PRECIO</th>
        <th scope="col">ACCIONES</th>       
      </tr>
    </thead>
    <tbody>
      @foreach ($info as $pro)       
        <tr>
          <th scope="row">{{$pro->nombre}}</th>
          <th scope="row">{{$pro->descripcion}}</th>
          {{-- <th scope="row">{{$pro->imagen}}</th> --}}
          <th scope="row">{{$pro->codigo_categoria}}</th>
          <th scope="row">{{$pro->stock}}</th>
          <th scope="row">{{$pro->precio}}</th>
          <th scope="row"><a href="{{route('eliPro',$pro)}}">✖️</a> |<a href="{{route('cargarProEdi',$pro)}}"> 🖊️</a></th>         
        </tr>
      @endforeach
    </tbody>
  </table>
    @endsection
</body>
</html>