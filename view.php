<?php
include("config.php");

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($post['title']); ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <a href="index.php">← Back to Blog</a>
  <h1><?php echo htmlspecialchars($post['title']); ?></h1>
  <p><strong>Category:</strong> <?php echo $post['category']; ?></p>
  <p><?php echo nl2br($post['content']); ?></p>
  <p><em>Posted on: <?php echo $post['created_at']; ?></em></p>
</body>
</html>
