<?php
    include_once "../conexion/conexion.php";
    include "metodos.php";
    $id=$_GET['id'];
    $obj= new metodos();
        if($obj->eliminarProductoCar($id)==1){               
            header("location:cliente.php");
        }else{
            echo "fallo al agregar";
        }
?>