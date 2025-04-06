<?php

session_start();
require 'config.php';

if(!isset($_SESSION['user_id'])){
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
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
      $title = $_POST['title'];
      $content = $_POST['content'];
      $editsql = "UPDATE POSTS SET title = ?, content = ? WHERE id = ? AND user_id = ?";
      $editstmt = $pdo->prepare($editsql);
      try{
        $editstmt->execute([$title,$content,$id,$user_id]);
        header("Location: dashboard.php");
        exit;
      } catch(PDOException $e){
        echo $e->getMessage();
      }
    }
  }else{
    echo "post not found";
  }
}




?>
<h2>Edit Post</h2>
<form method="POST">
  <label for="title">Title:</label>
  <input type="text" name="title" value="<?= htmlspecialchars($post['title']); ?>" required><br><br>

  <label for="content">Content:</label>
  <textarea name="content" required><?= htmlspecialchars($post['content']); ?></textarea><br><br>

  <button type="submit">Save Changes</button>
</form>


