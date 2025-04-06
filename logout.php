<?php

session_start();
require 'config.php';


if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
  $username = $_GET['username'];
  $sql = "SELECT * FROM USERS WHERE USERNAME=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  $user = $stmt -> fetch();

  unset($_SESSION['user']);
  unset($_SESSION['user_id']);
  session_destroy();
  header("Location: login.php");
  exit;
}else{
  echo "log out error";
}


?>
