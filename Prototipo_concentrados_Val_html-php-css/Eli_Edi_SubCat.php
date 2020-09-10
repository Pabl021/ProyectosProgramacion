
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
    <title>Manipular SubCategoría</title>
</head>
<body>

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
      <input class=" mr-sm-2" type="text" name="filtro" placeholder="🔎Buscar subcategoria..." aria-label="Search">
      <input  name="btnFiltro" class=" mr-sm-2" type="submit" value="Buscar">
      <input  name="btnTodo" class=" mr-sm-2" type="submit" value="Ver todo">
      <input  name="btnSalir" class=" mr-sm-2" type="submit" value="Cerrar Sección">

    </form>

  </div>
</nav>

<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Categoria</th>
      <th scope="col">Nombre</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    <?php
        include_once ('logicaDatos/subcategoriaDatos.php'); 
        include_once ('logicaDatos/categoriaDatos.php'); 
        $listaCategorias = mostrar_subcategorias(); 
        if(isset($_POST['btnFiltro'])){
          $listaCategorias = buscar_subcategorias_x_filtro($_POST['filtro']);
        }else if(isset($_POST['btnTodo'])){
          $listaCategorias  = mostrar_subcategorias();
        }

        if($listaCategorias){
        $txt = "";
        $i = 1; 
        foreach($listaCategorias as $sub){
          $catNombre = categoria_x_id(intval($sub->id_categoria))[0]->nombre; 
          $txt.="
            <tr>
              <th scope='row'>$i</th>
              <th>$catNombre</th> 
              <td>$sub->nombre</td>
              <td > <a href='crearSubCat.php?id_subcategoria=$sub->id'>✏️</a></td>
              <td > <a href='logicaDatos/subcategoriaDatos.php?id_sub=$sub->id'>⛔</a></td>  
            </tr>
            ";
             $i++; 
        }
        echo($txt);
        }else{
          echo("Sin registros"); 
        }
    ?>

  </tbody>
</table>
</body>
</html>
<?php
  if(isset($_POST['btnSalir'])){
      include ('logout.php'); 
  }
?>