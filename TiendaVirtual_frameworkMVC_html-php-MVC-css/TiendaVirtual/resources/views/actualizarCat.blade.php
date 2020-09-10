<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/login.css')?>" type="text/css"> 
    <title>Actualizar categoria</title>
</head>
<body>
    
</body>
</html>
@extends('layouts.menu')

@section('content')

 <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-5">
                <h1 class="text-center"><b>JP SPORT</b></h1>
                <h3 class="text-center">Tu tienda de confianza ✔️</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('editarCategoria') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$editar->id}}">
                        <input id="categoria" type="text" class="form-control @error('categoria') is-invalid @enderror" name="categoria" 
                        required autocomplete="categoria" placeholder="💡CATEGORÍA" autofocus value="{{$editar->nombre}}">
                            @error('categoria')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ "La categoría está nula❗" }}</strong>
                                </span>
                                    @enderror
                            <input  type="submit"  id="creaCu"  name="save" class="btn btn-info" value="Editar categoría">
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection