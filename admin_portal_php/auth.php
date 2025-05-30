<?php
session_start();
function require_login() {
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit;
    }
}
?>