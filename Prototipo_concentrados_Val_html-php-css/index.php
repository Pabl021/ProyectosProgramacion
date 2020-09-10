<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <title>Concentrados Valenciano</title>
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

  <a class="navbar-brand" href="index.php" style="color: #f7b178;"><h4><b>Concentrados Valenciano</b></h4></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
   <form class="form-inline my-2 my-lg-0" method="POST" rolwe="form">
      <li class="nav-item">  
        <select id="proC" name="rolCat" onchange="submit();">
          <option value="" selected="selected" >Escoja su categoría</option>  
          <?php
              include_once ('logicaDatos/categoriaDatos.php'); 
              $categorias = mostrar_categorias(); 
              if($categorias){
                $txt="";
                foreach($categorias as $c){
                  $txt.= "<option value='$c->id'>$c->nombre </option>"; 
                }
                echo "$txt"; 
            }
          ?>    
        </select>   
      </li>

      <li class="nav-item">  
        <select id="proC" name="rolsubCat" onchange="submit();">
          <option value="" selected="selected" >Escoja una subcategoría</option>  
          <?php
              include_once ('logicaDatos/subcategoriaDatos.php'); 
              $id_categoria =0; 
              if(isset($_POST['rolCat'])){
                $id_categoria = intval($_POST['rolCat']);
              }
              $subcategorias =  subcategoria_x_id_categoria($id_categoria);  
              if($subcategorias){
                $txt1="";
                foreach($subcategorias as $s){
                  $txt1.= "<option value='$s->id'>$s->nombre </option>"; 
                }
                echo "$txt1"; 
            }
          ?>    
        </select>   
      </li>
      </form>

      <li class="nav-item">
        <a class="nav-link" href="informacion.php">Más...</a>
      </li>
    </ul>


    <form class="form-inline my-2 my-lg-0" method="POST" role="form"> 
      <input class=" mr-sm-2" type="text" name="filtro" placeholder="🔎Buscar producto..." aria-label="Search">
    <input  class="btn btn-success"  id="creaCu" name="btnFiltro" class=" mr-sm-2" type="submit" value="Buscar">
    </form>

    <form action="administrador.php" method="POST" role="form">
    <a title="⚠ Área exclusiva para administradores ⚠"><input class="btn btn-success" type="submit" id="creaCu" href="administrador.php" value="Administrador" > </a>
    </form>
  </div>
</nav>



<div class="flip-card ">
  <div class="flip-card-inner ">
    <div class="flip-card-front ">
    <img src="" width="500" height="500" alt="">
    </div>
    <div class="flip-card-back">   
    </div>
  </div>
</div>


</body>
</html>

<?php
  /**Productos obtenidos por subcategorias */
  if(isset($_POST['rolsubCat'])){
    if(!empty($_POST['rolsubCat'])){
      include_once ('logicaDatos/productoDatos.php');
      $productos = productos_x_cat($_POST['rolsubCat']);
      if($productos){
       foreach($productos as $p){ 
            $image = base64_encode($p->imagen);
            if(!empty($image)){
              $image = "data:/image/jpg;base64,".$image;
            }else{
              $image = "../imagenes/sinfoto.jpg"; 
            }
            
         ?>
          <div class="card contenedor" style="width: 14rem; height: 20rem;" >
          <img  style=" width: 100px; height: 100px;" class=" img card-img-top" src="<?php echo $image?>" alt="Card image cap">
            <div class="card-body ">
            <div class="title">
            <b> <a style="color: green"><?php echo $p->nombre; ?></a></b>
            </div>
            <div style=" width: 190px; height: 100px;" class="desc"><?php echo  $p->descripcion; ?></div>
            <div >Precio: <?php echo $p->precio; ?></div>
            
          </div>
      </div>
          <?php
          
        }
      }
    }
  }
  ?>
  <?php
  /**Productos obtenidos por filtro  */
  if(isset($_POST['btnFiltro'])){
    if(!empty($_POST['filtro'])){
      include_once ('logicaDatos/productoDatos.php');
      $productosFiltro = buscar_producto_x_filtro($_POST['filtro']); 
      if($productosFiltro){
        foreach($productosFiltro as $p){
          $image = base64_encode($p->imagen);
            if(!empty($image)){
              $image = "data:/image/jpg;base64,".$image;
            }else{
              $image = "../imagenes/sinfoto.jpg"; 
            }
          ?>
          <div class="card contenedor" style="width: 14rem; height: 20rem;" >
          <img  style=" width: 100px; height: 100px;" class=" img card-img-top" src="<?php echo $image;?>" alt="Card image cap">
            <div class="card-body ">
            <div class="title">
            <b>  <a style="color:green;"><?php echo $p->nombre; ?></a></b>
            </div>
            <div style=" width: 190px; height: 100px;" class="desc"><?php echo  $p->descripcion; ?></div>
            <div >Precio: <?php echo $p->precio; ?></div>
            
          </div>
      </div> 
       <?php }
      }
    }
  }
?>