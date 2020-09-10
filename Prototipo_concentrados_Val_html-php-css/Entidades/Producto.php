
<?php

    class Producto{
        public $id; 
        public $id_subcategoria; 
        public $nombre; 
        public $descripcion; 
        public $imagen; 
        public $stock; 
        public $precio; 
        public $vendidos; 

        public function  ____construct($id_subcategoria, $nombre, $descripcion, $imagen, $stock, $precio){
            $this->id_subcategoria =$id_subcategoria; 
            $this->nombre =$nombre; 
            $this->descripcion =$descripcion;
            $this->imagen=$imagen;
            $this->stock =$stock; 
            $this->precio =$precio; 
            
        }

    }

?>