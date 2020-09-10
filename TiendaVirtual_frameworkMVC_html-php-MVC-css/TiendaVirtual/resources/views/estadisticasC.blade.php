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
                    <div class="card-body">
                        <form>
                            @csrf                      
                            <h3><label for="">Total de productos adquiridos: <b>{{count($totPro)}}</b> </label></h3></br>
                           <h3><label for="">Monto total de compras realizadas: <b>{{$precioPro}}</b></label></h3></br>                      
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>      
</body>
</html>
@endsection