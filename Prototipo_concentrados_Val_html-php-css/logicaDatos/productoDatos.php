
<?php
   // include_once ('Entidades/Producto.php');
    //include_once ('Entidades/User.php');
    include_once (__DIR__.'/../BaseDatos/productoBD.php');




    /**
     * Valida la llegada del id producto correctamente
     */
    if(isset($_GET['id'])){
        if(eliminar_producto($_GET['id'])){
          header('Location: ../adminOriginal.php?status=Inicio sección&message=Se elimino con exitó un producto!');
        }
    }

    function buscar_producto_x_filtro($text){
        return producto_x_filtro($text);
    }

    /**
     * Elimina producto
     */
    function eliminar_producto($id){
       return delete_producto($id);
    }
    /**
     * Guarda producto
     */
    function guardar_producto($p){
     //   is_datos_vacios($p);
     if(!empty($p->imagen)){
        $p->imagen = convert_image($p->imagen);
     }
     return insertar_producto($p);
    }
    /**
     * Muestra producto por id
     */
    function producto_x_id($id){
        return get_producto($id);
    }

     /**
     * Muestra producto
     */
    function mostrar_productos(){
        return obtener_productos();
    }

    /**
     * Muestra producto por categoria
     */
    function productos_x_cat($id_categoria){
        //llamar
        // if(!$isAdmin){
        //     return quitar_pr_existentes_en_carros(mostrar_productos_x_categoria($id_categoria));
        // }
        return mostrar_productos_x_categoria($id_categoria);
    }
    /**
     *Edita producto
     */
    function editar_producto($p){
        //is_datos_vacios($p);
      //  $p->imagen = convert_image($p->imagen);
        return modificar_producto($p);
    }
    /**
     *Convierte url de la imagen obtenida a imagen en bits
     */
    function convert_image($str_imagen){
        return addslashes(file_get_contents($str_imagen));
    }

     function convert_files(){
        $datos = array(
            "Image"=> array(
                "name" => "sinfoto.jpg",
                "type" => "image/jpeg",
                "tmp_name" => "C:\xampp\tmp\phpAB67.tmp",
                "error" => 0,
                "size" => 11249
            )
        ); 
        return $datos; 
     }
?>