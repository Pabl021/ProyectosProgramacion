<?php
  include_once("../conexion/conexion.php");
  include_once("metodos.php");
  require('functions.php');
  session_start();
  if($_SESSION && $_SESSION['user']) {
    $user1= $_SESSION['user'];
      if($user1['tipo'] != "cliente"){
          header('Location: index.php');
      }
  }else{
    header('Location: index.php');
  }
  $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compra</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>

    <style type="text/css">
      <?php
        include '../CSS/login.css';
      ?>
    </style> 

    <nav class=" navbar navbar-expand-lg navbar "style="background-color: #f7b178;">
      <a class="navbar-brand" href="" style="color: black;"><h2> <?php echo $user['nombre'] ?></h2></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <select id="proC" name="rolCat" onchange="location.href=this.value">
            <option selected disabled >*Escoja su categoría*</option>  
              <?php
                $obj= new metodos();
                $sql= "SELECT id, nombre FROM categoria";
                $datos=$obj->cargarCategorias($sql);
                  foreach ($datos as $key ) {                   
              ?>
                <option value="vista_cliente.php?id=<?php echo $key['id'] ?>"><?php echo $key['nombre']?>  </option>       
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

    <?php
      $con= new conectar();
      $conexion= $con->conexion();
      $id= $_GET['id'];
      $sql = "SELECT * FROM producto WHERE codigo_categoria='$id' AND stock>=2";
      $res= mysqli_query($conexion, $sql);
        while( $record = mysqli_fetch_assoc($res) ) {
      ?>
        <div class="card contenedor" style="width: 16rem; height: 26rem;" >
          <img  style=" width: 100px; height: 100px;" class=" img card-img-top" src="<?php echo $record['imagen']; ?>" alt="Card image cap">
            <div class="card-body ">
            <div class="title">
              <a style="color:green;"><?php echo $record['nombre']; ?></a>
            </div>
            <div style=" width: 190px; height: 100px;" class="desc"><?php echo $record['descripcion']; ?></div>
            <div >Precio: <?php echo $record['precio']; ?></div>
            <div >Código: <?php echo $record['id']; ?></div>
          <a href="añadir_prod_car.php?id=<?php echo $record['id']; ?> 
            && nom=<?php echo $record['nombre']; ?> 
            && idLog=<?php echo $user['id']; ?>
            && des=<?php echo $record['descripcion'];?>
            && precio=<?php echo $record['precio']; ?>"> 
            <button  type="submit" class="btn btn-primary" >🛒</button></a></div>
      </div>
      <?php } ?>

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
              $idP=$fill['id'];
            }
      ?>
      <a href="realizar_compra.php? idLog=<?php echo $user['id']; ?> ">  <button type="button" class="btn btn-success " data-toggle="modal" >Realizar Compra</button></a>
    </div>     
   </div>
  </div>

  </body>
</html>
