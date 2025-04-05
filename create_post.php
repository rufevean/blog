<?php 

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])){
  header("Location : login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $title = $_POST['title'];
  $content = $_POST['content'];
  $user_id = $_SESSION['user_id'];
 $sql = "INSERT INTO POSTS (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
  $stmt = $pdo->prepare($sql);
  try{
  $stmt->execute([$user_id,$title,$content]);
    echo"post created";
    header("Location: dashboard.php");
    exit;
  } catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>


<form method="post">
  <h2>Create a New Post</h2>
  Title: <input type="text" name="title" required><br><br>
  Content:<br>
  <a href="dashboard.php">← Back to Dashboard</a>
  <textarea name="content" rows="5" cols="40" required></textarea><br><br>
  <button type="submit">Post</button>
</form>
