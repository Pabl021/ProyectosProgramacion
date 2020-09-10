
<?php
ob_start();
  session_start();
  if(isset($_GET['id_subcategoria'])){
    $_SESSION['id_subcategoria'] = intval($_GET['id_subcategoria']); 
  }else{
    unset($_SESSION['id_subcategoria']);
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
      <title>Crear SubCategoría</title>

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
      $btnValue ="Crear SubCategoria";
      if(isset($_SESSION['id_subcategoria'])){
          include_once ('logicaDatos/subcategoriaDatos.php'); 
          $cat = subcategoria_x_id($_SESSION['id_subcategoria']); 
          $btnName = "btnEditar"; 
          $btnValue ="Editar SubCategoria";
      }   
      $nombre = trim(isset($cat[0]->nombre)? ($cat[0]->nombre): "","");  
?> 

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-5 contSC">
                    <h1 class="text-center" style="color: #f7b178;"><b>Concentrados Valenciano</b></h1>
                    <h3 class="text-center" style="color: #f7b178;">Tu tienda de alimentos de confianza ✔️</h3>
                      <form  method="POST" role="form">
                        <input id="inNombre"type="text" class="form-control" value="<?php echo($nombre); ?>" name="subCat" placeholder="📝SubCategoría" autocomplete="off"><br>
                        <select id="crearSub" name="rolCat">
                          <option value="" selected="selected" >Categoría a la que pertenece</option>   
                          <?php
                              include_once ('logicaDatos/categoriaDatos.php'); 
                              $categorias = mostrar_categorias(); 
                              if($categorias){
                                foreach($categorias as $c){
                                  $txt.= "<option value='$c->id'>$c->nombre </option>"; 
                                }
                                echo "$txt"; 
                              }
                          ?>         
                        </select> 
                        <a href=""><input type="submit" name="<?php echo($btnName);?>" value="<?php echo($btnValue);?>" class="btn btn-primary"> </a>
                      </form>
                </div>
                <div class="col-md-4"></div>
        </div>
    </div>

  </body>
</html>

<?php
    include_once ('Util/Util.php');
    include_once ('Entidades/SubCategoria.php');
    include_once ('logicaDatos/subcategoriaDatos.php');

    if(isset($_POST['btnGuardar'])){
      $sub = new SubCategoria();
      $sub->id_categoria = $_POST['rolCat'];
      $sub->nombre = $_POST['subCat'];
      if(!empty($sub->nombre)){
         if(guardar_subcategoria($sub)){
           alert("Se guardo con exitó"); 
           header("Location:adminOriginal.php");
         }else{
           alert("algo salio mal"); 
         }
      }else{
        alert("Datos vacíos, por favor escriba un nombre"); 
      }
    }

    if(isset($_POST['btnEditar'])){
      $sub = new SubCategoria();
      $sub->id = intval($_SESSION['id_subcategoria']); 
      $sub->id_categoria = $_POST['rolCat'];
      $sub->nombre = $_POST['subCat'];
      if(!empty($sub->nombre)){
         if(editar_subcategoria($sub)){
           header('Location: adminOriginal.php?status=editado con exitó!');
         }else{
           alert("algo salio mal"); 
         }
      }else{
        alert("Datos vacíos, por favor escriba un nombre"); 
      }
    }

?>
<?php
  if(isset($_POST['btnSalir'])){
      include ('logout.php'); 
  }
?>