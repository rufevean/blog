<?php

session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit;
}

if (isset($_GET['id'])){
  $id = $_GET['id'];
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM POSTS WHERE id=? and user_id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id,$user_id]);
  $post = $stmt->fetch();
  if($post){
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
      $deleteSql = "DELETE FROM POSTS WHERE id = ? AND user_id = ?";
      $deleteStmt = $pdo->prepare($deleteSql);
      try{
        $deleteStmt->execute([$id,$user_id]);
        header("Location: dashboard.php");
        exit;
      } catch (PDOException $e){
        echo $e->getMessage();
      }
    }
  }else{
    echo "post not found";
  }

}else{
  echo "no post id specified";
  exit;
}

?>

<a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</a>

