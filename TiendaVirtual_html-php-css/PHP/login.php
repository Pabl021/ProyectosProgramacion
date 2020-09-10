<?php
  session_start();
  require('functions.php');
  require_once "../conexion/conexion.php";
    if($_POST) {
      $username = $_REQUEST['usuario'];
      $password = $_REQUEST['contra'];
      $user = authenticate($username, $password);     
      
        if($user) {
          session_start();
          $_SESSION['user'] = $user;
          if($user["tipo"] == "cliente"){
            header('Location:cliente.php');
          }else if($user["tipo"] == "administrador"){
            header('Location:administrador.php');
          }
        } else {
          header('Location:index.php?status=login');
        }
    }
  
?>
