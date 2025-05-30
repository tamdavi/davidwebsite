<?php
require '../auth.php';
require_login();
require '../config.php';

if (isset($_GET['mark']) && is_numeric($_GET['mark'])) {
    $stmt = $pdo->prepare("UPDATE messages SET status = 'read' WHERE id = ?");
    $stmt->execute([$_GET['mark']]);
}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
}

$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Manage Messages</title></head>
<body>
<h1>Manage Contact Messages</h1>
<table border="1">
<tr><th>Name</th><th>Email</th><th>Message</th><th>Status</th><th>Actions</th></tr>
<?php foreach ($messages as $msg): ?>
<tr>
    <td><?php echo $msg['name']; ?></td>
    <td><?php echo $msg['email']; ?></td>
    <td><?php echo $msg['message']; ?></td>
    <td><?php echo $msg['status']; ?></td>
    <td>
        <a href="?mark=<?php echo $msg['id']; ?>">Mark as Read</a> |
        <a href="?delete=<?php echo $msg['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
