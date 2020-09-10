<?php
  include_once "../conexion/conexion.php";
  include "metodos.php";
  $obj= new conectar();
  $conexion= $obj->conexion();
  $idLog=$_GET['idLog'];
  $sql1 = "SELECT * FROM producto_comprar WHERE id_cliente=$idLog AND compro=true";
  $res1= mysqli_query($conexion, $sql1);
    foreach ($res1 as $key) {
        $id_pro=$key['id_producto'];
        $sql="UPDATE producto SET stock=(stock-1) WHERE id=$id_pro";
          mysqli_query($conexion, $sql);    
    }
  $sql="UPDATE producto_comprar SET compro='false' WHERE  id_cliente=$idLog";
  mysqli_query($conexion, $sql);
  header("location:cliente.php");
?>

