<?php
// Show errors for debugging (optional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
include("config.php");

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the blog post
    $stmt = $conn->prepare("SELECT title, content, author_id, category, created_at FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->store_result();

    // Check if post exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($title, $content, $author_id, $category, $created_at);
        $stmt->fetch();
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f9f9f9; }
        .post { background: #fff; padding: 20px; border-left: 5px solid #007BFF; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; }
        .meta { color: #666; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="post">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <div class="meta">
            <strong>Category:</strong> <?php echo htmlspecialchars($category); ?> |
            <strong>Date:</strong> <?php echo $created_at; ?>
        </div>
        <div class="content">
            <?php echo nl2br($content); ?>
        </div>
    </div>
</body>
</html>
