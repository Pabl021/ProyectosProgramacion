<?php

    include_once "../conexion/conexion.php";
    include "metodos.php";
    $id=$_GET['id'];
    $sql = "SELECT * FROM producto WHERE codigo_categoria=$id";
    $con= new conectar();
    $conexion= $con->conexion();
    $result= mysqli_query($conexion, $sql); 
    $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $obj= new metodos();
        if(!$data){
            if($obj->eliminarCategoria($id)==1){               
                header("location:manipular_categoria.php");
            }else{
                echo "fallo al agregar";
            }
        }else{
            header("location:manipular_categoria.php");       
        }
?>