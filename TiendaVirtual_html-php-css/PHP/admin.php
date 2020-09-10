<?php
  session_start();
  $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
  </head>
  <body> 
      <?php  
        if($user["tipo"] == "cliente") { 
          header('Location: cliente.php');
        }else{
          header('Location: administrador.php');
        } 
      ?>  
  </body>
</html>