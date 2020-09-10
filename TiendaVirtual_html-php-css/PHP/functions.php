<?php
  include_once "../conexion/conexion.php";
    function getConnection() {
      $connection = new mysqli("localhost","root","","jpsport");
        if ($connection->connect_errno) {
          printf("Connect failed: %s\n", $connection->connect_error);
          die;
        }
      return $connection;
    }

    function authenticate($username, $password){
      $conn = getConnection();
      $sql = "SELECT * FROM cliente WHERE nomUsu = '$username' AND contra = '$password'";
      $result = $conn->query($sql);
        if ($conn->connect_errno) {
          $conn->close();
          return false;
        }
      $conn->close();
      return $result->fetch_assoc();
    }
?>