<?php
    
    require_once (__DIR__.'/../Entidades/SubCategoria.php'); 
    include_once ('productoBD.php'); 

    /**
     * $categoria categoria a guardar en la base datos
     * inserta una categoria a la base datos
     */
    function insertar_subcategoria($sub){
        if(subcategoria_x_nombre($sub, true)){
            $sub->id_categoria = intval($sub->id_categoria);
            $con = getConexion(); 
            $sql  = "INSERT INTO subcategoria(id_categoria,nombre) VALUES ('$sub->id_categoria','$sub->nombre')"; 
            $result = $con->query($sql);
            if($con->connect_errno){
                $con->close(); 
                return false; 
            }
            $con->close(); 
            return $result; 
        }
        return false;
    }
    /**
     * $id id de la categoria
     * elimina la categoria de la base datos
     */
    function delete_subcategoria($id){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "DELETE FROM `subcategoria` WHERE id = $id"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $con->close(); 
        return $result; 
    }
    /**
     * obtiene todas las categorias disponibles
     */
    function get_subcategorias(){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "SELECT * FROM subcategoria"; 
        $result = $con->query($sql); 

        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $get_categ = array(); 
        $categorias = $result->fetch_all();
        foreach($categorias as $c){
            array_push($get_categ, obtener_subcategoria($c)); 
        }  
        $con->close(); 
        return $get_categ; 
    }
    /**
     * $categoria categoria a busccar por nombre
     * $isSave true, si es para guardar o false si es solo para buscar
     * busca una categoria por mnombre, para no guardar con mismo nombre
     */
    function subcategoria_x_nombre($sub, $isSave){
        $con = getConexion(); 
        $sqlNombre = "SELECT * FROM subcategoria WHERE nombre = '$sub->nombre'"; 
        $sqlIdNombre = "SELECT * FROM subcategoria WHERE id != '$sub->id' AND nombre = '$sub->nombre'"; 
        $sql = $isSave ? $sqlNombre:$sqlIdNombre; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $subcategorias = $result->fetch_all();
        if(count($subcategorias)>0){ 
            if(strtolower($subcategorias[0][2])===strtolower($sub->nombre)){
                return false; 
            }
        }
        return true; 
    }

    /**
     * $categoria categoria a editar
     * edita una categoria en especifico
     */
    function editar_subcategoria($categoria){
        if(subcategoria_x_nombre($categoria, false)){
            include_once ('conexion.php');
            $con = getConexion(); 
            $sql = "UPDATE subcategoria SET id_categoria='$categoria->id_categoria', nombre = '$categoria->nombre' WHERE id = '$categoria->id'"; 
            $result = $con->query($sql); 

            if($con->connect_errno){
                $con->close(); 
                return false; 
            }
            return $result; 
         }
    }

    function subcategoria_x_filtro($text){
        $con = getConexion(); 
        $sql ="SELECT * FROM subcategoria WHERE nombre LIKE '%$text%'" ;
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $subcate_dev= array(); 
        $subcat = $result->fetch_all(); 
        foreach ($subcat as $sub) {
            array_push($subcate_dev, obtener_subcategoria($sub)); 
        }
        return $subcate_dev; 
    }


    /**
     * $id_categoria id de la categoria
     * muestra una categoria por el id 
     */
    function mostrar_subcategoria($id_categoria){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "SELECT * FROM subcategoria WHERE id = $id_categoria"; 

        $result = $con->query($sql); 

        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $get_categ = array(); 
        $categorias = $result->fetch_all();
        foreach($categorias as $c){
            array_push($get_categ, obtener_subcategoria($c)); 
        }  
        $con->close(); 
        return $get_categ; 
    }

    function mostrar_subcategoria_x_categoria($id_categoria){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "SELECT * FROM subcategoria WHERE id_categoria = $id_categoria"; 

        $result = $con->query($sql); 

        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $get_categ = array(); 
        $categorias = $result->fetch_all();
        foreach($categorias as $c){
            array_push($get_categ, obtener_subcategoria($c)); 
        }  
        $con->close(); 
        return $get_categ; 
    }

    /**
     * $catResult obtenido de la base datos
     * obtiene todos los datos de una categoria
     */
    function obtener_subcategoria($catResult){
      //  $listPro = mostrar_productos_x_categoria($catResult[0]); 
        $cat= new SubCategoria(); 
        $cat->id = $catResult[0]; 
        $cat->id_categoria = $catResult[1];
        $cat->nombre = $catResult[2]; 
       // $cat->listaProductos =$listPro ? $listPro:NULL; 
        return $cat; 
    }

?>