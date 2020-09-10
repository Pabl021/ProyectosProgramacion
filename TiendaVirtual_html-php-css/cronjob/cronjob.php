<?php
    include "conexion.php";
    function cargarPro($cant){
        $obj= new conectar();
        $con= $obj->conexion();
        $sql= "SELECT * FROM producto WHERE stock <=$cant";
        $res= $con->query($sql);
            if ($con->connect_errno) {
                $con->close();
                return false;
            }
        $pro=$res->fetch_all();
        return $pro;
    }

?>
