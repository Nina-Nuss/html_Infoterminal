<?php
session_start();

$username = "nina";

setcookie('username', $username, time() + 86400 * 30); // 30 Tage
// ...existing code...
$username = $_SESSION['username'] ?? ($_COOKIE['username'] ?? null);
if (!$username) {
    header('Location: ../login/index.php');
    exit;
}
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

echo $username;
?>