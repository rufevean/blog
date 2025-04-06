<?php 

session_start();
require 'config.php' ;

if (!isset($_SESSION['user'])){
  header("Location: login.php");
  exit; 

}

$user_id=$_SESSION['user_id'];

$sql = "SELECT * FROM POSTS WHERE user_id = ?";
$stmt = $pdo->prepare($sql); 
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll();




?>


<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
<h2>Your Posts</h2>

<form action="logout.php" method="GET">
    <button type="submit">Log Out</button>
</form>
<form action="create_post.php" method="get">
  <button type="submit">+ Create New Post</button>
</form>

<?php if (count($posts) > 0): ?>
  <ul>
<?php foreach ($posts as $post): ?>

<a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete Post</a>


      <a href="edit_post.php?id=<?= $post['id']; ?>">Edit</a>
      <li>
        <strong><?php echo htmlspecialchars($post['title']); ?></strong><br>
        <?php echo nl2br(htmlspecialchars($post['content'])); ?><br>
        <small>Posted on <?php echo $post['created_at']; ?></small>
        <hr>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>You have no posts yet.</p>
<?php endif; ?>

