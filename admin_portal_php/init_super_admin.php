<?php
require 'config.php';

$username = 'superadmin';
$password = 'superpassword';
$role = 'super';

// Check if superadmin already exists
$stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo "⚠️ Superadmin already exists. No new user created.";
    exit;
}

// Hash password and insert
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO admins (username, password, role) VALUES (?, ?, ?)");
$stmt->execute([$username, $hashedPassword, $role]);

echo "✅ Superadmin created successfully.";
?>
