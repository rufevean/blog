<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username=$_POST['username'];
  $password=$_POST['password'];
  
  $sql="SELECT * FROM USERS WHERE USERNAME=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password,$user['password'])){
    $_SESSION['user']=$user['username'];
    $_SESSION['user_id']=$user['id'];
    header("Location: dashboard.php");
    exit;
  }else{
    echo "log in failed";
  }

}

?>


<form method="post">
  <h1> Login </h1>
  Username:<input type='text' name='username' required><br><br>
  Password:<input type='password' name='password' required><br><br>
  <button type='submit'>login</button>
</form>
