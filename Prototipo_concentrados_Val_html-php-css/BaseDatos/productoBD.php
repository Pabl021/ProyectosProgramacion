<?php

    include_once ('conexion.php');
    include_once (__DIR__.'/../Entidades/Producto.php');

    /**
     * $p producto recibido para guardar en la base datos
     * Va a la base datos y guarda un producto, y se la asocia a la categoria
     */
    function insertar_producto($p){
        $con = getConexion(); 
       // $sql ="INSERT INTO producto(id_categoria, nombre, descripcion, imagen, stock, precio) 
        $sql ="INSERT INTO producto(id_subcategoria, nombre, descripcion, precio, imagen) 
        VALUES ('$p->id_subcategoria','$p->nombre','$p->descripcion','$p->precio','$p->imagen')";

        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $con->close(); 
        return $result; 
    }
    /**
     * $p producto editado, recibido para cambiar en la base datos
     * Va a la base datos y edita un producto
     */
    function modificar_producto($p){
        $con = getConexion(); 
        $sql ="UPDATE `producto` SET id_subcategoria='$p->id_subcategoria', nombre='$p->nombre', descripcion='$p->descripcion', precio='$p->precio' WHERE id =$p->id"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close();
            return false; 
        }
        $con->close(); 
        return $result; 
    }

      /**
     * $id producto a editar, recibido para cambiar en la base datos
     * $cantidad a restar
     * Baja la cantidad del stock
     */
    function modificar_producto_stock($id,$cantidad,$vendidos){
        $con = getConexion(); 
        $sql ="UPDATE `producto` SET stock='$cantidad', vendidos='$vendidos' WHERE id =$id"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close();
            return false; 
        }
        $con->close(); 
        return $result; 
    }

    /**
     * $id id del producto
     * Obtiene un producto en especifico por id
     */
    function get_producto($id){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto`
         WHERE id = $id";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $producto = $result->fetch_all(); 
        foreach ($producto as $p) {
            return cargar_producto($p); 
        }
    }

   function producto_x_filtro($text){
        $con = getConexion(); 
        $sql ="SELECT * FROM producto WHERE nombre LIKE '%$text%' OR descripcion LIKE '%$text%' OR precio LIKE '%$text%'" ;
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $productos_dev= array(); 
        $productos = $result->fetch_all(); 
        foreach ($productos as $p) {
            array_push($productos_dev, cargar_producto($p)); 
        }
        return $productos_dev; 
    }

    /**
     * $id_categoria el id de la categoria a la que esta asociado
     * obtiene todos los productos de la categoria padre a la que pertenece
     */
    function mostrar_productos_x_categoria($id_categoria){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto` WHERE id_subcategoria = $id_categoria";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $productos_cate= array(); 
        $productos = $result->fetch_all(); 
        foreach ($productos as $p) {
            array_push($productos_cate, cargar_producto($p)); 
        }
        return $productos_cate; 
    }
 
    function obtener_productos(){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto`";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $productos_dev= array(); 
        $productos = $result->fetch_all(); 
        foreach ($productos as $p) {
            array_push($productos_dev, cargar_producto($p)); 
        }
        return $productos_dev; 
    }

    /**
     * $id del producto
     * elimina un producto de los registros
     */
    function delete_producto($id){
        $con = getConexion(); 
        $sql ="DELETE FROM producto
         WHERE id = $id";
        $result = $con->query($sql);

        if($con->connect_errno){
            $con-close();
            return false; 
        }
        return $result; 
    }
    /**
     * $resultP array de productos obtenidos en la base datos
     * Convierte los datos a un objeto de tipo Producto
     */
    function cargar_producto($resultP){
        $p = new Producto(); 
        $p->id = $resultP[0]; 
        $p->id_categoria = $resultP[1]; 
        $p->nombre = $resultP[2]; 
        $p->descripcion = $resultP[3]; 
        $p->imagen= $resultP[4]; 
        $p->stock = $resultP[5]; 
        $p->precio = $resultP[6]; 
        $p->vendidos = $resultP[7]; 

        return $p; 
    }


?>