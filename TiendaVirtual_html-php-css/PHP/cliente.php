<?php 
include_once "../conexion/conexion.php";
include_once "metodos.php";
session_start();
$user= $_SESSION['user'];
require('functions.php');
if($_SESSION && $_SESSION['user']) {
  $user1= $_SESSION['user'];
    if($user1['tipo'] != "cliente"){
        header('Location: index.php');
    }
}else{
  header('Location: index.php');
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
      <title>✔️Cliente</title>
  </head>
  <body >

  <style type="text/css">
      <?php
        include '../CSS/login.css';
      ?>
  </style> 


  <nav class=" navbar navbar-expand-lg navbar "style="background-color: #f7b178;">

      <a class="navbar-brand" href="#">
      <img src="jpstore.jpeg" width="60" height="60" alt="">
      </a>
    <a class="navbar-brand" href="cliente.php" style="color: black;"><h2> <?php echo $user['nombre'] ?></h2></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">   
        <select id="proC" name="rolCat" onchange="location = this.value">
          <option value="cliente.php" selected="selected" >Escoja su categoría</option>  
            <?php
                  $obj= new metodos();
                  $sql= "SELECT id, nombre FROM categoria";
                  $datos=$obj->cargarCategorias($sql);

                  foreach ($datos as $key ) {                   
                  ?>         
                  <option  value="vista_cliente.php?id=<?php echo $key['id'] ?>"><?php echo $key['nombre']?>  </option>       
                      <?php
                  }
                      ?>
        </select>              
      </ul>

      <form class="form-inline my-2 my-lg-0">
        <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#myModal">🛒</button>
      </form>

      <form class="form-inline my-2 my-lg-0">
        <a class="estadis" href="estadisticas_cliente.php" style="color:black;"><h5>Compras realizadas</h5></a>
      </form>

      <form class="form-inline my-2 my-lg-0">
        <a class="cerrar_ses" href="/logout.php" style="color:black;"><h5>Cerrar Sesión</h5></a>
      </form>
    </div>
  </nav>


  <div class="container">
      <div class="row">
          <div class="col-md-3"></div>
              <div class="col-md-5 ">
                  <h1 class="text-center"><b>JP STORE</b></h1>
                  <h3 class="text-center">Tu tienda de confianza ✔️</h3>
                  <h3 class="text-center">Datos de compra</h3>
                  <form action="" method="POST"> 
                    <?php              
                      $obj= new conectar();
                      $conexion= $obj->conexion();
                      $sqlTp="SELECT count(*) id FROM producto_comprar WHERE id_cliente=$user[id] AND compro=false";
                      $result= mysqli_query($conexion, $sqlTp);
                      $ver=mysqli_fetch_row($result);
                      $totVen=implode($ver);

                      $montoPro="SELECT SUM(precio) FROM producto_comprar WHERE id_cliente=$user[id] AND compro=false";
                      $result= mysqli_query($conexion, $montoPro);
                      $ver=mysqli_fetch_row($result);
                      $total=implode($ver);
                    ?>
                      <label for=""><h4 class="text-center">Total de productos comprados:<b> <?php  echo $totVen; ?> </b></h4> </label>        
                      <label for=""><h4 class="text-center">Monto total de productos comprados:<b> <?php  echo $total; ?> </b></h4> </label>        
                  </form>            
              </div>
            <div class="col-md-4"></div>
      </div>
  </div>


  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">       
          <h4 class="modal-title">Lista de productos a comprar</h4>
        </div>
      <div class="modal-body">
        
        <table class="table table-striped table-dark">
  
                  <tr>
                  <td scope="col">Nombre</td>
                  <td scope="col" >Precio</td>
                  <td scope="col" >Eliminar</td>
                </tr>
            <?php
              $idlog=$user['id'];
              $con= new conectar();
              $conexion= $con->conexion();
              $sql = "SELECT * FROM producto_comprar WHERE id_cliente=$idlog AND compro=true";
              $res= mysqli_query($conexion, $sql);
              while($fil= mysqli_fetch_array($res)){
            ?>
              <tr>                 
                  <td> <?php echo $fil['nombre']?></td>
                  <td> <?php echo $fil['precio']?></td>
                  <td > <a href="eli_pro_car.php?id=<?php echo $fil['id'] ?>">⛔</a></td>                 
                </tr>
            <?php
              }
            ?>
            
        </table>

        
  <?php
      $idlog=$user['id'];
      $con= new conectar();
      $conexion= $con->conexion();
      $suma="SELECT SUM(precio) FROM producto_comprar WHERE id_cliente=$idlog AND compro=true";   
      $consulta = mysqli_query($conexion,$suma);
      
      $sum = 0; 
      while ($row = mysqli_fetch_array($consulta)){
        $suma= intval($row[0]);                   
      }  
  ?>
      <label for=""><h3>EL total a pagar es de: <?php echo $suma ?></h3> </label>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

      <?php 
        $con= new conectar();
         $conexion= $con->conexion();
        $sql1 = "SELECT id FROM producto_comprar WHERE id_cliente=$idlog AND compro=true";
        $res1= mysqli_query($conexion, $sql1);
        while($fill=mysqli_fetch_array($res1)){                  
        }
      ?>
        <a href="realizar_compra.php? idLog=<?php echo $user['id']; ?>">  <button type="button" class="btn btn-success " data-toggle="modal" >Realizar Compra</button></a>

      </div>
    </div>
  </div>
  </body>
</html>


