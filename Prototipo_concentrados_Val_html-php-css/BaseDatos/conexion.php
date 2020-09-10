<?php
    /**
     * Devuelve la conexion obtenida a la base datos
     */
    function getConexion(){
        $servidor ="localhost";
        $usuario = "root";
        $clave = "";
        $base_datos = "valencio";
        $conexion= mysqli_connect($servidor, $usuario, $clave, $base_datos);
        return $conexion; 
    }

?>