<?php
    include_once (__DIR__.'/../BaseDatos/categoriaBD.php'); 

    delete();
    /**
     * Valida la llegada del id correctamente
     */
    function delete(){
        if(isset($_GET['id'])){
            eliminar_categoria($_GET['id']); 
        }
    }

    function buscar_categorias_x_filtro($text){
        return categorias_x_filtro($text); 
    }
    /**
     * Edita una categoria
     */
    function editar_categ($categoria){
        return editar_categoria($categoria); 
    }
    /**
     * Guarda una categoria
     */
    function guardar_categoria($categoria){
        return insertar_categoria($categoria); 
    }
     /**
     * Muestra categorias
     */
    function mostrar_categorias(){
        return get_categorias(); 
    }

     /**
     * Muestra una categoria por id
     */
    function categoria_x_id($id){
        return mostrar_categoria($id);
    }
    /**
     * Elimina una categoria, y redireciona a la pagina original
     */
    function eliminar_categoria($id){
        if(mostrar_categoria($id)[0]->listaProductos==NULL){
         if(delete_categoria($id)){
              header('Location: ../adminOriginal.php?status=Admin&message=eliminó');
          }
        }else{
            header('Location: ../adminOriginal.php?status=Admin&message=error prod');
        }
    }

    function validar_usuario($user,$pass){
        return login($user, $pass);
    }

?>