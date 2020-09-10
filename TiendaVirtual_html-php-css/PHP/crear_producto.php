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
  include_once "metodos.php";
  $errors = '';

  if(isset($_POST['save'])){
    $nombre= $_POST['nombre'];
    $des= $_POST['descripcion'];
    $arch= $_FILES['archivo']['name'];
    $ruta=$_FILES['archivo']['tmp_name'];
    $destino="imgPro/".$arch;
    copy($ruta, $destino);
    $rolCat= $_POST['rolCat'];
    $stock= $_POST['stock'];
    $precio= $_POST['precio'];

      if((empty($nombre))  ){
        $errors =  '¡¡¡ El nombre es requerido !!!';          
      }else if((empty($des))){
        $errors =  '¡¡¡ La descripción es requerida !!!';          
      }else if($_FILES['archivo']['name'] == null){
        $errors =  '¡¡¡ La imagen es requerida !!!';          
      }else if((empty($rolCat))  ){
        $errors =  '¡¡¡ La categoría del producto es requerida !!!';          
      }else if((empty($stock))  ){
        $errors =  '¡¡¡ El stock es requerido !!!';          
      }else if(!is_numeric($stock)){
        $errors =  '¡¡¡ El stock debe ser solo números !!!';          
      }else if((empty($precio))  ){
        $errors =  '¡¡¡ El precio es requerido !!!';          
      }else if(!is_numeric($precio)){
        $errors =  '¡¡¡ El precio debe ser solo números !!!';          
      }else{                       
        $datos= array($nombre,$des, $destino, $rolCat, $stock, $precio);           
        $obj= new metodos();
          if($obj->insertarProducto($datos)==1){               
            header("location:administrador.php");
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
    <title>Crear Categoría</title>

    <script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function() {
          $(".content").fadeOut(1500);
        },2000);  
      });
    </script>
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
      <a class="navbar-brand" href="administrador.php" style="color: black;"><h2> Administrador</h2></a>
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

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                Productos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #f7b178;">
                <a class="dropdown-item" href="crear_producto.php">Crear producto</a>
                <a class="dropdown-item" href="manipular_producto.php">Ver/Editar/Eliminar producto</a>               
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
                    <h3 class="text-center">Crear producto</h3>
                      <form action="" method="POST" enctype="multipart/form-data">
                        <p id="error" class="help is-danger content "><?= $errors ?></p>
                        <input id="inNom" type="text" class="form-control" name="nombre" placeholder="NOMBRE" autocomplete="off"><br>
                        <input id="inDes" type="text" class="form-control" name="descripcion" placeholder="DESCRIPCION" autocomplete="off"><br>
                        <input id= inIma name="archivo" type="file" ><br><br>
                        <label><h5> Visite la opción "código de categorias sino recuerda su código"</h5> </label>
                        <select id="proC" name="rolCat">          
                        <?php
                          $obj= new metodos();
                          $sql= "SELECT * FROM categoria";
                          $datos=$obj->cargarCategoriasP($sql);                                         
                          foreach ($datos as $key ) {
                        ?>
                            <option value="<?php echo $key['id']?>"><?php echo $key['id']?></option>                  
                        <?php
                          }
                        ?>                   
                        </select><br><br>
                        <input id="inSto" type="text" class="form-control" name="stock" placeholder="STOCK" autocomplete="off"><br>
                        <input id="inPre" type="text" class="form-control" name="precio" placeholder="PRECIO" autocomplete="off"><br>
                        <input type="submit" name="save" value="Crear producto" class="btn btn-primary"> 
                      </form>  
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ver códigos de categorías</button>                 
                </div>
                <div class="col-md-4"></div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">       
        <div class="modal-content">
          <div class="modal-header">
          
            <h4 class="modal-title">Categorías y sus códigos</h4>
          </div>
        <div class="modal-body">
          <?php
            $obj= new metodos();
            $sql= "SELECT * FROM categoria";
            $datos=$obj->cargarCategoriasP($sql);                                   
              foreach ($datos as $key ) {
          ?>
            <p><?php echo $key['id']?> - <?php echo $key['nombre']?></p>                  
          <?php
              }
          ?>           
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
