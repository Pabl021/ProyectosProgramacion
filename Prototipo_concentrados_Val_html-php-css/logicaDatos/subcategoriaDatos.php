<?php
    include_once (__DIR__.'/../BaseDatos/subcategoriaBD.php'); 

    deleteSub();
    /**
     * Valida la llegada del id correctamente
     */
    function deleteSub(){
        if(isset($_GET['id_sub'])){
            eliminar_subcategoria($_GET['id_sub']); 
        }
    }
    /**
     * Edita una subcategoria
     */
    function editar_subcateg($categoria){
        return editar_subcategoria($categoria); 
    }

    function buscar_subcategorias_x_filtro($text){
        return subcategoria_x_filtro($text);
    }

    /**
     * Guarda una subcategoria
     */
    function guardar_subcategoria($sub){
        return insertar_subcategoria($sub); 
    }
     /**
     * Muestra subcategorias
     */
    function mostrar_subcategorias(){
        return get_subcategorias(); 
    }

     /**
     * Muestra una subcategoria por id
     */
    function subcategoria_x_id($id){
        return mostrar_subcategoria($id);
    }
    function subcategoria_x_id_categoria($id_categoria){
        return mostrar_subcategoria_x_categoria($id_categoria);
    }
    /**
     * Elimina una subcategoria, y redireciona a la pagina original
     */
    function eliminar_subcategoria($id){
        if(mostrar_subcategoria($id)[0]->listaProductos==NULL){
         if(delete_subcategoria($id)){
              header('Location: ../adminOriginal.php?status=Admin&message=eliminó');
          }
        }else{
            header('Location: ../adminOriginal.php?status=Admin&message=error prod');
        }
    }

?>