<?php
    include "cronjob.php";
    $canPro=$argv[1];
    $proSto=cargarPro($canPro);
        if($proSto){
            $proBajos="";
                foreach ($proSto as $datosP) {
                $id= $datosP[0];
                $nom= $datosP[1];
                $proBajos.= "SKU: $id \nNombre: $nom\n";
                }
                    echo $proBajos;
                    $sub="Actualización de stocks";
                    $msj= "Estos productos se encuentran bajos de stock\nFavor actualizar\n".$proBajos;
                    $rec= "josepablobc2000@gmail.com";
                    mail($rec, $sub, $msj);
            
        }else{
            echo "los productos no existen con ese stock";
        }
?>