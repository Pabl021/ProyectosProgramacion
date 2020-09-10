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
    <title>Registro</title>
</head>
<body>
    
</body>
</html>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-5">
                <h1 class="text-center"><b>JP SPORT</b></h1>
                <h3 class="text-center">Tu tienda de confianza ✔️</h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="👨‍💼 NOMBRE" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "El nombre es requerido❗" }}</strong>
                                    </span>
                                @enderror
                            

                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" placeholder="👨‍💼 APELLIDO" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "El apellido es requerido❗" }}</strong>
                                    </span>
                                @enderror

                                <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" pattern="^[6|7|8|]\d{7}$" value="{{ old('telefono') }}" required autocomplete="telefono" placeholder="📞 TELÉFONO" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "El teléfono es requerido❗" }}</strong>
                                    </span>
                                @enderror

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="📧 CORREO">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "El email es requerido❗" }}</strong>
                                    </span>
                                @enderror

                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" placeholder="🌆 DIRECCIÓN" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "La dirección es requerida❗" }}</strong>
                                    </span>
                                @enderror



                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="🔐 CONTRASEÑA">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "Revisa tus contraseñas❗" }}</strong>
                                    </span>
                                @enderror
                        

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="🔐 RE-CONTRASEÑA">
                           
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
