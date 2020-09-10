<?php
  ob_start();

?>

<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <title>Administrador</title>

  </head>

  <body > 
    <style type="text/css">
        <?php
        include 'css.css';
        ?>
    </style> 
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-5 admin">
                    <h1 class="text-center" style="color: #f7b178;"><b>Concentrados Valenciano</b></h1>
                    <h3 class="text-center" style="color: #f7b178;">Tu tienda de alimentos de confianza ✔️</h3>
                      <form  method="POST" role="form">
                        <input id="inNombre"type="text" class="form-control" name="usuario" placeholder="👁️USUARIO" autocomplete="off">
                        <input id="inPass"type="password" class="form-control" name="contra" placeholder="🔐CONTRASEÑA">
                        <input name="login" type="submit" value="Iniciar sesión" class="btn btn-primary">
                      </form>
                                   
                </div>
                <div class="col-md-4"></div>
        </div>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['login'])){
    include_once ('logicaDatos/categoriaDatos.php'); 
    include_once ('Util/Util.php'); 
    $user = validar_usuario($_POST['usuario'],$_POST['contra']);
    if($user){
      session_start();
      $_SESSION['user'] = $user; 
      header ('Location: adminOriginal.php');
    }
    alert("No tiene acceso a esta sección, o datos incorrectos");
  }

?>