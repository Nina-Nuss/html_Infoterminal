<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['is_active'] != 1) {
    header('Location: ../login/index.php');
    exit;
}
?>