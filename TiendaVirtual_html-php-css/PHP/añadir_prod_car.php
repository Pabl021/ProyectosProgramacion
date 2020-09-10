<?php
     include_once "../conexion/conexion.php";
     include "metodos.php";

     $con= new conectar();
    $conexion= $con->conexion();
    $idLog=$_GET['idLog'];
    $idPro=$_GET['id'];
    $nomPro=$_GET['nom'];  
    $precio=$_GET['precio'];
    $compro=true;
    date_default_timezone_set('America/Costa_Rica');
    $time = time();
    $fecha=date("d-m-Y",$time);
    
        $datos= array($idLog,$idPro, $nomPro,$precio,$compro,$fecha);           
        $obj= new metodos();
        if($obj->insertarProductoCompra($datos)==1){               
            header("Location:cliente.php?id=$idPro");
        }         
        else{
            echo "fallo al agregar";
        }


?>


