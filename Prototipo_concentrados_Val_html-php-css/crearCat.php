
<?php
ob_start();
  session_start();
  if(isset($_GET['id_categoria'])){
    $_SESSION['id_categoria'] = intval($_GET['id_categoria']); 
  }else{
    unset($_SESSION['id_categoria']);
  }
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
      <title>Crear Categoría</title>

  </head>

  <body > 
 
  <style type="text/css">
        <?php
        include 'css.css';
        ?>
    </style> 


<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="#">
      <img src="imagenes/logo.jpeg" width="60" height="60" alt="">
      </a>

  <a class="navbar-brand" href="adminOriginal.php" style="color: #f7b178;"><h4><b>Concentrados Valenciano Admin</b></h4></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categoría
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="verCat.php">Ver categoría</a>  
          <a class="dropdown-item" href="crearCat.php">Crear categoría</a>        
          <a class="dropdown-item" href="Eli_Edi_Cat.php">Eliminar/Editar Categoría</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SubCategoría
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="verSubCat.php">Ver Subcategoría</a>  
          <a class="dropdown-item" href="crearSubCat.php">Crear Subcategoría</a>        
          <a class="dropdown-item" href="Eli_Edi_SubCat.php">Eliminar/Editar SubCategoría</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Producto
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="verPro.php">Ver Productos</a>  
          <a class="dropdown-item" href="crearPro.php">Crear producto</a>        
          <a class="dropdown-item" href="Eli_Edi_Pro.php">Eliminar/Editar Producto</a>
        </div>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" role="form">
      <input  name="btnSalir" class=" mr-sm-2" type="submit" value="Cerrar Sección">
    </form>
  </div>
</nav>

    <?php
      $btnName = "btnGuardar"; 
      $btnValue ="Guardar";
      if(isset($_SESSION['id_categoria'])){
          include_once ('logicaDatos/categoriaDatos.php'); 
          $cat = categoria_x_id($_SESSION['id_categoria']); 
          $btnName = "btnEditar"; 
          $btnValue ="Editar";
      }   
      $nombre = trim(isset($cat[0]->nombre)? ($cat[0]->nombre): "","");  
    ?> 

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-5 contCC">
                    <h1 class="text-center" style="color: #f7b178;"><b>Concentrados Valenciano</b></h1>
                    <h3 class="text-center" style="color: #f7b178;">Tu tienda de alimentos de confianza ✔️</h3>
                      <form  method="POST" role="form">
                        <input id="inNombre"type="text" class="form-control" name="cat" placeholder="📝Categoría" autocomplete="off" value="<?php echo($nombre);?>">
                        <a href=""><input name="<?php echo($btnName);?>" type="submit" value="<?php echo ($btnValue); ?>" class="btn btn-primary"> </a>
                      </form>
                                   
                </div>
                <div class="col-md-4"></div>
        </div>
    </div>

  </body>
</html>
<?php
    include_once ('Util/Util.php'); 
    include_once ('Entidades/Categoria.php');
    include_once ('logicaDatos/categoriaDatos.php');

    if(isset($_POST['btnGuardar'])){
      if(!empty($_POST['cat'])){
        $cat = new Categoria();
        $cat->nombre = trim($_POST['cat']); 
        if(guardar_categoria($cat)){
          alert("Se guardó una nueva categoría con exito");
          //header('Location:'.$_SERVER['PHP_SELF']); 
          header('Location: adminOriginal.php?status=guardada con exitó!');

        }else{
          alert("Surgio un error, es probable que este ingresando una categoria ya existente"); 
        }
      }else{
        alert("Debe de escribir un nombre, no pueden quedar vacíos los datos"); 
      }
    }


    if(isset($_POST['btnEditar'])){
      if(!empty($_POST['cat'])){
        $cat = new Categoria();
        $cat->id = $_SESSION['id_categoria'];
        $cat->nombre = trim($_POST['cat']); 
        if(editar_categoria($cat)){
            alert("Edito una categoria con exitó");
            unset($_SESSION['id_categoria']); 
            header('Location: adminOriginal.php?status=editado con exitó!');
        }
      }
    }
?>
<?php
  if(isset($_POST['btnSalir'])){
      include ('logout.php'); 
  }
?>