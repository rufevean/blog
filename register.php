<?php

require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username=$_POST['username'];
  $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

  $sql = "INSERT INTO USERS (username,password) VALUES (?,?)";
  $stmt = $pdo->prepare($sql);
  try{
    $stmt->execute([$username,$password]);
    echo"registerd";
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}
  

?>




<form method="post"> 
  Username:<input type='text' name='username' required><br><br>
  Password:<input type='password' name='password' required><br><br>
  <button type='submit'>register</button>

</form>
