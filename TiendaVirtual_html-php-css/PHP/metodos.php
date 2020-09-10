<?php
    class metodos{
        /**
         * método encargado de insertarme el registro de
         * clientes registrados a la BD.
         */
        public function insertarCliente($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "INSERT INTO cliente(nombre, apellido, telefono, correo, direccion, nomUsu, contra, tipo) 
            values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]')";         
            return $result= mysqli_query($conexion, $sql);           
        }
        /**
         * método encargado de insertarme categorías creadas 
         * por el admin a su respectiva BD.
         */
        public function insertarCategoria($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "INSERT INTO categoria(nombre) values('$datos[0]')";           
            return $result= mysqli_query($conexion, $sql);           
        }
        /**encargado de cargarme todas las categorias que se encuentran 
         * en la base de datos
        */
        public function cargarCategorias($sql){
            $con= new conectar();
            $conexion= $con->conexion();
            $result= mysqli_query($conexion, $sql); 
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        /**me carga las categorias de sus productos */
        public function cargarCategoriasP($sql){
            $con= new conectar();
            $conexion= $con->conexion();
            $result= mysqli_query($conexion, $sql); 
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        /**si el cliente desea actualizar una categoria
         * este metodo se encargara de guardarme los nuevos datos
         */
        public function actualizarCategorias($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "UPDATE categoria set nombre='$datos[0]' WHERE id='$datos[1]'";
            return $result= mysqli_query($conexion, $sql);
        }
        /**si el admin desea eliminar una categoria
         * este metodo se encargara de eliminarme el dato seleccionado
         */
        public function eliminarCategoria($id){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql="DELETE from categoria WHERE id='$id'";
            return $result= mysqli_query($conexion, $sql);
        }
        /**metodo encargado de insertarme los nuevos productos creados */
        public function insertarProducto($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "INSERT INTO producto(nombre, descripcion, imagen, codigo_categoria, stock, precio)
             values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";           
            return $result= mysqli_query($conexion, $sql);           
        }
        /**metodo encargado de cargarme todos los productos
         * de la base de datos
         */
        public function cargarProductos($sql){
            $con= new conectar();
            $conexion= $con->conexion();
            $result= mysqli_query($conexion, $sql); 
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        /**si el admin desea eliminar un producto
         * este metodo se encargara de eliminarme el dato seleccionado
         */
        public function eliminarProducto($id){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql="DELETE from producto WHERE id='$id'";
            return $result= mysqli_query($conexion, $sql);
        }
        /**encargado de actualizarme los productos en la Base de Datos */
        public function editarProducto($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "UPDATE producto set nombre='$datos[0]',descripcion='$datos[1]',imagen='$datos[2]', 
            codigo_categoria='$datos[3]', stock='$datos[4]', precio='$datos[5]' WHERE id='$datos[6]'";
            return $result= mysqli_query($conexion, $sql);
        }
        /**con este insertamos los productos que los
         * clientes ya decidieron comprar
         */
        public function insertarProductoCompra($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "INSERT INTO producto_comprar(id_cliente, id_producto,nombre,precio,compro,fecha)
            values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";          
            return $result= mysqli_query($conexion, $sql);           
        }
        /**encargado de eliminarme el producto del carrito si el cliente
         * no lo desea comprar
         */
        public function eliminarProductoCar($id){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql="DELETE from producto_comprar WHERE id='$id'";
            return $result= mysqli_query($conexion, $sql);
        }
        /**con este metodo insertamos todos los datos de las compras del cliente. */
        public function insertarDatosCompra($datos){
            $con= new conectar();
            $conexion= $con->conexion();
            $sql= "INSERT INTO compras_realizadas(idLog, fecha,nombre,precio)
            values('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";          
            return $result= mysqli_query($conexion, $sql);           
        }          
    }
?>