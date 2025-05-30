<?php
require '../auth.php';
require_login();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];
    $pdo->query("DELETE FROM about");
    $stmt = $pdo->prepare("INSERT INTO about (content, experience, education) VALUES (?, ?, ?)");
    $stmt->execute([$content, $experience, $education]);
}

$about = $pdo->query("SELECT * FROM about LIMIT 1")->fetch();
?>
<!DOCTYPE html>
<html>
<head><title>Manage About</title></head>
<body>
<h1>Manage About Section</h1>
<form method="POST">
    Content: <textarea name="content" required><?php echo $about['content'] ?? ''; ?></textarea><br>
    Experience: <textarea name="experience"><?php echo $about['experience'] ?? ''; ?></textarea><br>
    Education: <textarea name="education"><?php echo $about['education'] ?? ''; ?></textarea><br>
    <input type="submit" value="Update About">
</form>
</body>
</html>
