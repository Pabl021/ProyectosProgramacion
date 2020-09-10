<?php

session_start();
  if($_SESSION && $_SESSION['user']) {
    $user= $_SESSION['user'];
      if($user['tipo'] != "administrador"){
          header('Location: index.php');
      }
  }else{
    header('Location: index.php');
  }
  $user = $_SESSION['user'];
  
    include_once "../conexion/conexion.php";
    include "metodos.php";
    $obj= new conectar();
    $conexion= $obj->conexion();
    $id= $_GET['id'];
    $sql="SELECT id, nombre FROM categoria WHERE id='$id'";
    $result= mysqli_query($conexion, $sql);
    $ver=mysqli_fetch_row($result);
    $errors = '';

    if(isset($_POST['save'])){
        $nombre= $_POST['catEdi'];
        $id=$_GET['id'];
            if((empty($nombre))  ){
                $errors =  '¡¡¡ La categoría es requerida !!!';          
            }else{                       
                $datos= array($nombre, $id);           
                $obj= new metodos();
                    if($obj->actualizarCategorias($datos)==1){               
                        header("location:manipular_categoria.php");
                    }else{
                        echo "fallo al agregar";
                    }           
            }    
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Editar Categoria</title>
    </head>

    <body>
        <style type="text/css">
            <?php
            include '../CSS/login.css';
            ?>
        </style> 

        <nav class=" navbar navbar-expand-lg navbar "style="background-color: #f7b178;">
            <a class="navbar-brand" href="#">
                <img src="jpstore.jpeg" width="60" height="60" alt="">
            </a>
            <a class="navbar-brand" href="#" style="color: black;"><h2> Administrador</h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #f7b178;">
                            <a class="dropdown-item" href="crear_categoria.php">Crear categoría</a>
                            <a class="dropdown-item" href="manipular_categoria.php">Ver/Editar/Eliminar categoría</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="cerrar_se" href="/logout.php" style="color:black;"><h5>Cerrar Sesión</h5></a>
                </form>
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                    <div class="col-md-5 ">
                        <h1 class="text-center"><b>JP STORE</b></h1>
                        <h3 class="text-center">Tu tienda de confianza ✔️</h3>
                        <h3 class="text-center">Editar categoría</h3>
                        <form action="" method="POST">
                            <input type="text" hidden="" value="<?php echo $id ?>" name="id">                    
                            <p id="error" class="help is-danger content "><?= $errors ?></p>
                            <input id="inCat" type="text" class="form-control" name="catEdi" placeholder="💡Crear categoría💡" autocomplete="off" value="<?php echo $ver[1]?>">
                            <input type="submit" name="save" value="Actualizar categoría" class="btn btn-primary"> 
                        </form>            
                    </div>
                <div class="col-md-4"></div>
            </div>
        </div>

    </body>
</html>