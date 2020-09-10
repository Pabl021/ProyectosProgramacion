<?php
  include "../conexion/conexion.php";
  include "metodos.php"; 

  $errors = '';
    if(isset($_POST['save'])){
      $nombre= $_POST['txtnombre'];
      $apellido= $_POST['txtapellido'];
      $telefono= $_POST['txttelefono'];
      $correo= $_POST['txtcorreo'];
      $direccion= $_POST['txtdireccion'];
      $usuario= $_POST['txtnomUsu'];
      $contra= $_POST['txtcontraseña'];
      $cliente= "cliente";
        if((empty($nombre))  ){
          $errors =  '¡¡¡ El nombre es requerido !!!';          
        }else if(empty($apellido)){
          $errors =  '¡¡¡ El apellido es requerido !!!';
        }else if(empty($telefono)){
          $errors =  '¡¡¡ El teléfono es requerido !!!';
        }else if(empty($correo)){
          $errors =  '¡¡¡ El correo es requerido !!!';
        }else if(empty($direccion)){
          $errors =  '¡¡¡ El dirección es requerida !!!';
        }else if(empty($usuario)){
          $errors =  '¡¡¡ El usuario es requerido !!!';
        }else if(empty($contra)){
          $errors =  '¡¡¡ La contraseña es requerida !!!';
        }else{                       
          $datos= array($nombre,$apellido,$telefono,$correo,$direccion,$usuario,$contra,$cliente);           
          $obj= new metodos();
            if($obj->insertarCliente($datos)==1){               
              header("location:index.php");
            }else{
              echo "fallo al agregar";
            }  
        }      
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function() {
          $(".content").fadeOut(1500);
        },2000);
      });
    </script>
  </head>

  <body>   
    <style type="text/css">
      <?php
        include '../CSS/login.css';
      ?>
    </style>  
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-5">
                    <h1 class="text-center"><b>JP SPORT</b></h1>
                    <h3 class="text-center">Tu tienda de confianza ✔️</h3>
                    <h3 class="text-center">📓 Formulario de ingreso 📓</h3>
                    <form action="" method="POST">
                      <p id="error" class="help is-danger content "><?= $errors ?></p>
                      <input id="inNombre"type="text" class="form-control" name="txtnombre" placeholder="👨‍💼 Nombre" autocomplete="off">
                      <input id="inApe"type="text" class="form-control" name="txtapellido" placeholder="👨‍💼 Apellido" autocomplete="off">
                      <input id="inTel"type="tel" class="form-control" pattern="^[6|7|8|]\d{7}$" name="txttelefono" placeholder="📞 Teléfono" autocomplete="off">
                      <input id="inCor"type="email" class="form-control" name="txtcorreo" placeholder="📧 correo" autocomplete="off">
                      <input id="inDir"type="text" class="form-control" name="txtdireccion" placeholder="🌆 dirección" autocomplete="off">
                      <input id="inUsu"type="text" class="form-control" name="txtnomUsu" placeholder="👁️ Usuario" autocomplete="off">
                      <input id="inCon"type="password" class="form-control" name="txtcontraseña" placeholder="🔐 Contraseña" autocomplete="off">
                      <input  type="submit"  id="creaCu"  name="save" class="btn btn-info" value="Registrarme">                      
                    </form>
                </div>
              <div class="col-md-4"></div>
        </div>
    </div>

  </body>
</html>


