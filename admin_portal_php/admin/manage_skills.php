<?php
require '../auth.php';
require_login();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $level = $_POST['level'];
    $stmt = $pdo->prepare("INSERT INTO skills (name, level) VALUES (?, ?)");
    $stmt->execute([$name, $level]);
}

$skills = $pdo->query("SELECT * FROM skills")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Manage Skills</title></head>
<body>
<h1>Manage Skills / Services</h1>
<form method="POST">
    Skill/Service: <input type="text" name="name" required><br>
    Level: <input type="text" name="level" required><br>
    <input type="submit" value="Add">
</form>
<h2>Current Skills</h2>
<table border="1">
<tr><th>Name</th><th>Level</th></tr>
<?php foreach ($skills as $skill): ?>
<tr>
    <td><?php echo $skill['name']; ?></td>
    <td><?php echo $skill['level']; ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
