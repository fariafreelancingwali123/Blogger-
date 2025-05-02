<?php
$host = 'localhost';
$user = 'u9lvfenc0ixyv';
$pass = 'vnggpsky9ix3';
$dbname = 'dbmlttan2gxeas';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false;

// When the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $author_id = 1; // Static for now; can be dynamic if needed

    // Insert the post into the database
    $stmt = $conn->prepare("INSERT INTO posts (title, content, author_id, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $content, $author_id, $category);
    $stmt->execute();

    // Redirect to index.php with a success message
    header("Location: index.php?status=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 30px; }
        .form-container { background: white; padding: 25px; max-width: 600px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, textarea, select { width: 100%; padding: 10px; margin-bottom: 15px; }
        button { background: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create New Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" rows="8" placeholder="Write your content..." required></textarea>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="Technology">Technology</option>
            <option value="Lifestyle">Lifestyle</option>
            <option value="Business">Business</option>
            <option value="Travel">Travel</option>
        </select>
        <button type="submit">Publish</button>
    </form>
</div>

</body>
</html>
