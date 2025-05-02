<?php
$host = 'localhost';
$user = 'u9lvfenc0ixyv';
$pass = 'vnggpsky9ix3';
$dbname = 'dbmlttan2gxeas';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get posts from the database
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 30px; }
        .container { max-width: 800px; margin: auto; }
        .post { background: white; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        .create-btn { display: inline-block; background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .title { color: #333; margin-bottom: 10px; }
        .success { background: #d4edda; padding: 15px; border-radius: 5px; color: #155724; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h1>My Blog</h1>

    <!-- Success message after creating a post -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="success">
            ✅ Post successfully added!
        </div>
    <?php endif; ?>

    <a href="create.php" class="create-btn">+ Create Post</a>
    <br><br>

    <!-- Display Posts -->
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="post">
            <h2 class="title"><?= htmlspecialchars($row['title']) ?></h2>
            <p><?= nl2br(substr($row['content'], 0, 150)) ?>...</p>
            <small>Category: <?= htmlspecialchars($row['category']) ?></small>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
