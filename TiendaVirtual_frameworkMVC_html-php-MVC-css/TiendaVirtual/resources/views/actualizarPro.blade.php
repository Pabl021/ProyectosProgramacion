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
    <title>Actualizar producto</title>
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
                    <form method="POST" action="{{route('editarProducto') }}" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="id" value="{{$editar->id}}">
                        <input required id="inNom" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $editar->nombre}}" placeholder="NOMBRE"autocomplete="off"  autofocus  autocomplete="nombre"><br>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "El nombre está nulo❗" }}</strong>
                            </span>
                        @enderror
                        <input required id="inDes" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ $editar->descripcion }}" placeholder="DESCRIPCION" autocomplete="off" autofocus  autocomplete="descripcion"><br>
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "La descripción es nula❗" }}</strong>
                            </span>
                        @enderror
                        <input required id="inIma" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" value="{{ $editar->imagen }}" autocomplete="off"  autofocus  autocomplete="imagen"><br>
                        @error('imagen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "La imagen es nula❗" }}</strong>
                            </span>
                        @enderror
                    <select required  id="proC" name="codigo_categoria" class="form-control @error('categoria') is-invalid @enderror" value="{{ $editar->categoria }}" autocomplete="off" autofocus  autocomplete="categoria">    
                        <option value="">SELECCIONE UNA CATEGORÍA</option>                    
                            @foreach ($categoria as $cat)                          
                                <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                            @endforeach   
                        </select><br> 
                        @error('codigo_categoria')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "La categoria es nula❗" }}</strong>
                            </span>
                        @enderror
                        <input required id="inSto" type="text" min="1" pattern="^[0-9]+" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $editar->stock }}" autocomplete="off" placeholder="STOCK" autofocus autocomplete="stock"><br>
                        @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "Revisa el Stock❗" }}</strong>
                            </span>
                        @enderror                      
                        <input required id="inPre" type="text" min="1" pattern="^[0-9]+" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ $editar->precio }}" autocomplete="off" placeholder="PRECIO" autofocus  autocomplete="precio"><br>
                        @error('precio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ "Revisa el precio❗" }}</strong>
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